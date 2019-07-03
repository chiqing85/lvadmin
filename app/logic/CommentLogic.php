<?php

namespace App\logic;

use App\Blacklist;
use App\Comment;
use App\Events\NewComments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CommentLogic extends Model
{
    /**
     * @title 最新5条回复
     * @return mixed
     */
    static function new()
    {
        return Cache::rememberForever('CNew',function ()
        {
            return Comment::whereIn('status', [0, 1])
                ->orderBy('id', 'desc')
                ->with('article:id,title')
                ->limit('5')
                ->get();
        });
    }
    /**
     * @title 添加回复
     * @return false|string
     */
    static function create() {
        $req = request()->all();
        $ip = request()->getClientIp();

        if( Blacklist::where('ip', $ip)->first() ) {
            $code = 0;
            $message = '抱歉，您已被系统拉入黑名单…';
        } elseif( adblock( ( $req['contents'] ) ) ) {
            if( Cache::has( $ip )) {
                Cache::increment( $ip );
            } else {
                Cache::put( $ip, 0, 60 * 60 * 24 );
            }
            $code = 0;
            $message = '留言失败，疑似广告…';
        } else {
            if ( empty( $req['name']) ) {
                $req['item'] = '匿';
            } else if( \Auth::check() ){
                $req['item_pic'] = \Auth::user()->pic;
            } else {
                $fristr = mb_substr( $req['name'], 0, 1, 'utf8');
                if(preg_match("/^[a-zA-Z]/", $fristr)) {
                    $frist = ucfirst( $fristr );
                } else {
                    $frist = GetFirst( $fristr );
                }
                $req['item'] = $frist;
            }
            if( Cache::has( $ip ) && Cache::get( $ip) >= 3) {
                $req['status'] = -2;
                $message = '发表成功，等待管理员审核…';
            }
            $req['ip'] = $ip;
            $info = Comment::create( $req );

            if( $info) {
                $code = 1;
                $message = empty( $message ) ? '成功…' : $message;
                Cache::forget('CNew');
                // 广播通知给后台
                event( new NewComments() );
            }
        }
        $data = array(
            'code'=> $code,
            'message' => $message
        );
        return json_encode( $data );
    }

    /**
     * @title 获取评论
     * @return mixed
     */
    static function getcomms() {
        if( request('page') ) {
            Cache::forget('comms');
        }
        return Cache::remember('comms', 60, function () {
            return Comment::where('modelid', 1)
                ->whereNotIn('status', ['-3'])
                ->orderBy('id', 'desc')
                ->with('article:id,title')
                ->paginate( 15 );
        });
    }

    /**
     * @title 拉入黑名单
     * @param $callback
     * @return false|string
     */
    static function black( $callback ) {
        $ip = $callback->ip;
        $find = Blacklist::where('ip', $ip)->first();
        if( $find ){
            $code = 0;
            $msg = "该IP已在黑名单中…";
        } else {
            Blacklist::create( array('ip' => $ip) );

            $callback->update(['status' =>  '-1']);

            Comment::where('modelid', 1)
                ->where('ip', $ip)
                ->where('status', 0)
                ->update(['status'=> '-1']);
            Cache::forget('comms');
            $code = 1;
            $msg = '已拉入黑名单…';
        }
        $data = array(
            'code' => $code,
            'message' => $msg,
            'url' => '/admin/comments'
        );
        return json_encode( $data);
    }

    /**
     * @title 信息审核
     * @param $callback
     * @return false|string
     */
    static function review( $callback )
    {
        $status = $callback->status;
        if( $status == 1 )
        {
            $code = 0;
            $message = "信息已是通过状态…";
        } else if( $status == '-1') {
            $code = 0;
            $message = '失败，该信息用户IP已被拉入黑名单…';
        } else if( $status == 0 || $status ==  '-2' ) {
            $callback->update([ 'status' => 1 ]);
            $code = 1;
            $message = "审核成功…";

            if($callback->modelid ) {
                Cache::forget('comms');
                $url =  '/admin/comments';
            } else {
                Cache::forget('gcontacts');
                $url = "/admin/contacts";
            }
        }

        $data = array(
            'code' => $code,
            'message' => $message,
            'url' => $url
        );
        return json_encode( $data );
    }

    /**
     * @title 软删除
     * @param $callback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    static function deletel( $callback )
    {
        $callback->update(['status' => '-3' ]);
        Cache::forget('comms');
        Cache::forget('recycle');
        return redirect('/admin/comments');
    }

    /**
     * @title 批量 软删除
     * @param $callback
     */
    static function deleteall( $callback )
    {
        $info =  Comment::whereIn('id', $callback['id'] )
             ->update(['status'=> '-3']);
        if( $info ) {
            $data = array(
                'code' => 1,
                'message' => '删除成功…',
                'url' => '/admin/comments'
            );
        } else {
            $data = array(
                'code' => 0,
                'message' => '删除失败…',
            );
        }
        Cache::forget('comms');
        return json_encode( $data );
    }

    /**
     * @title 评论 回收站
     * @return mixed
     */
    static function recycle()
    {
        if( request('page') ) {
            Cache::forget('recycle');
        }
        return Cache::remember('recycle', 60, function () {
            return Comment::where('status', '-3')
                ->orderBy('id', 'desc')
                ->with('article:id,title')
                ->paginate( 15 );
        });
    }

    /**
     * @title 评论恢复
     * @param $callback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    static function rleupd( $callback )
    {
        if( $callback->status == '-3')
        {
            $callback->update([ 'status' => 1 ]);
            Cache::forget( 'recycle' );
            Cache::forget('comms');
            return redirect('/admin/comments/recycle');
        }
    }


    /**
     * @title 永久删除
     * @param $callback
     * @return \Illuminate\Http\RedirectResponse
     */
    static function rledel( $callback )
    {
        if( $callback->status == '-3')
        {
            $callback->delete();
            Cache::forget('recycle');
            return redirect('/admin/comments/recycle');
        }
    }

    /**
     * @title 批量永久删除
     * @param $callback
     * @return false|string
     */
    static function rledelall( $callback )
    {
        $info = Comment::destroy( $callback['id'] );
        if( $info ) {
            $data = array(
                'code' => 1,
                'message' => '删除成功…',
                'url' => '/admin/comments/recycle'
            );
        } else {
            $data = array(
                'code' => 0,
                'message' => '删除失败…',
            );
        }
        Cache::forget('recycle');
        return json_encode( $data );
    }

    /**
     * @title 灭霸响指，回收站全清空
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    static function empty()
    {
         Comment::where('status','-3')
            ->delete();
        Cache::forget('recycle');
        return redirect('/admin/comments/recycle');
    }

    /**
     * @title 提交反馈
     * @return false|string
     */
    static function contacts()
    {
        $req = request()->all();
        $ip = request()->getClientIp();
        if( \Auth::check() ){
            $req['item_pic'] = \Auth::user()->pic;
        } else {
            $fristr = mb_substr($req['name'], 0, 1, 'utf8');
            if (preg_match("/^[a-zA-Z]/", $fristr)) {
                $frist = ucfirst($fristr);
            } else {
                $frist = GetFirst($fristr);
            }
            $req['item'] = $frist;
        }
        $req['ip'] = $ip;
        $info = Comment::create( $req );
        if( $info )
        {
            $data = array(
                'code'=> 1,
                'message' => '提交成功……<br />有新回复时我们将通过邮箱通知您……'
            );
            // 广播通知
            event( new NewComments());
            Cache::forget('CNew');
            return json_encode( $data );
        }
    }

    /**
     * @title 获取反馈列表
     * @return mixed
     */
    static function gcontacts()
    {
        if( request('page') ) {
            Cache::forget('gcontacts');
        }
        return Cache::remember('gcontacts', 60, function () {
            return Comment::where('modelid', 0)
                ->whereNotIn('status', ['-3'])
                ->orderBy('id', 'desc')
                ->paginate( 15 );
        });
    }


    static function reply()
    {
        $data = request()->all();
        $data['name'] = \Auth::user()->username;
        $data['item_pic'] = \Auth::user()->pic;
        $data['uid'] = \Auth::user()->id;
        $data['ip'] = request()->getClientIp();
        $data['status'] = 1;
        $find = Comment::find( request('parentid'));
        $info = Comment::create( $data );
        if( $info )
        {
            if( $find->status == 0) {
                $find->status = 1;
                $find->save();
            }
            $req = array(
                'code'=> 1,
                'message' => '提交成功……'
            );
            Cache::forget('CNew');
            Cache::forget('gcontacts');
            return json_encode( $req );
        }
    }
}
