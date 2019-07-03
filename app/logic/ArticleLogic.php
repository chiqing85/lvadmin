<?php

namespace App\logic;

use App\Aclass;
use App\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ArticleLogic extends Model
{
    /**
     * @title 内容列表
     * @return mixed
     */
    protected function list() {
        if( request('page') ) {
            Cache::forget('artic');
        }
        return Cache::remember('artic', 60, function () {
            return Article::orderBy('sorts', 'asc')
                ->orderBy('id', 'desc')
                ->with('aclass:id,name')
                ->paginate( 15 );
        });
    }

    /**
     * @title  添加新文章
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function create() {
        $data = request()->all();
        $data['content'] = trim( $data['editor-html-code'] );
        unset($data['editor-html-code']);
        $data['keywords'] = rtrim( $data['keywords'], ',');
        Article::create( $data );
        Cache::forget('artic');
        return redirect('/admin/article');
    }

    /**
     * @title 更新
     * @param $callback
     * @return Redirector
     */
    protected function up( $callback ) {
        $data = request()->all();
        $data['content'] = trim( $data['editor-html-code'] );
        unset($data['editor-html-code']);
        $data['keywords'] = rtrim( $data['keywords'], ',');
        $callback->update( $data );
        Cache::forget('artic');
        return redirect('/admin/article');
    }

    /**
     * @title 字段更新
     * @param $callback
     * @return false|string
     */
    protected function edit( $callback ) {
        $info = $callback->update(
            \request()->all()
        );
        if( $info ) {
            $data = array(
                'code' => 1,
                'message' => '更新成功…',
                'url' => '/admin/article'
            );
            Cache::forget('artic');

        } else {
            $data = array(
                'code' => 0,
                'message' => '更新失败…',
            );
        }
        return json_encode( $data );
    }

    /**
     * @title 多删除
     * @param $callback
     * @return false|string
     */
    protected function deleall( $callback ) {
        $info = Article::destroy( $callback['id'] );
        if( $info ) {
            $data = array(
                'code' => 1,
                'message' => '删除成功…',
                'url' => '/admin/article'
            );
            Cache::forget('artic');
        } else {
            $data = array(
                'code' => 0,
                'message' => '删除失败…',
            );
        }
        return json_encode( $data );
    }

    /**
     * @title 删除
     * @param $callback
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function deletel( $callback ) {
        $callback->delete();
        Cache::forget('artic');
        return back();
    }

    /**
     * @title 前台文章列表
     * @return mixed
     */
    protected function homelist() {
        if( request('page') ) {
            Cache::forget('homelist');
        }
        return Cache::remember('homelist', 60, function () {
            return Article::whereHas( 'aclass', function( $query ) {
                    $query->where('mid', 0);
                })
                ->orderBy('flag', 'desc')
                ->orderBy('sorts', 'asc')
                ->orderBy('id', 'desc')
                ->withCount( ['comment' => function($query ) {
                    $query->whereNotIn('status', ['-3']);
                }])
                ->paginate( 12 );
        });
    }

    /**
     * @title 文章类别列表
     * @param $callback
     * @return mixed
     */
    static function Categories( $callback ) {
        $aid = Aclass::where('dirs', $callback)->get('id')->toArray();
        $aid = $aid[0]['id'];
        if( request('page') ) {
            Cache::forget('Categories'.$aid );
        }
        return Cache::remember('Categories'.$aid , 60, function( ) use( $aid ) {
            return Article::where('pid', $aid )
                ->orderBy('flag', 'desc')
                ->orderBy('sorts', 'asc')
                ->orderBy('id', 'desc')
                ->withCount( ['comment' => function($query ) {
                    $query->whereNotIn('status', ['-3']);
                }])
                ->paginate( 15 );
        });
    }

    /**
     * @title 关于我
     * @return mixed
     */
    static function about()
    {
        return Cache::remember('about', 3600 * 24, function () {
           return Article::whereHas('aclass', function ($query ) {
               $query->where('mid', 1);
           })->first();
        });
    }
}
