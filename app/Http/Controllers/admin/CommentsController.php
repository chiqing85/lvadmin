<?php

namespace App\Http\Controllers\admin;

use App\Comment;
use App\logic\CommentLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use phpDocumentor\Reflection\Types\Self_;
use function PHPSTORM_META\elementType;

class CommentsController extends Controller
{
    /**
     * @title 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $comment = CommentLogic::getcomms();
        return view('admin.comments.index', compact( 'comment'));
    }

    /**
     * @title 拉黑
     * @param Comment $comment
     * @return false|string
     */
    public function black( Comment $comment) {
        return CommentLogic::black( $comment );
    }

    /**
     * @title 审核
     * @param Comment $comment
     * @return false|string
     */
    public function review( Comment $comment) {
        return CommentLogic::review( $comment );
    }

    /**
     * @ttile 软删除
     * @param Comment $comment
     */
    public function delete( Comment $comment )
    {
        return CommentLogic::deletel( $comment );
    }

    /**
     * @title 批量软删除
     * @return false|string
     */
    public function deleteall()
    {
        return CommentLogic::deleteall( \request()->all() );
    }

    /**
     * @title 评论 回收站
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recycle()
    {
        $comment =  CommentLogic::recycle();
        return view('admin.comments.recycle', compact( 'comment'));
    }

    /**
     * @title 恢复
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function rleupd( Comment $comment )
    {
        return CommentLogic::rleupd( $comment );
    }

    /**
     * @title 永久删除
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rledel( Comment $comment )
    {
        return CommentLogic::rledel( $comment );
    }

    /**
     * @title 批量永久删除
     * @return false|string
     */
    public function rledelall()
    {
        return CommentLogic::rledelall( request()->all() );
    }

    /**
     * @title 清空回收站
     * @return mixed
     */
    public function empty()
    {
        return CommentLogic::empty();
    }

    /**
     * @title 反馈列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        $contacts = CommentLogic::gcontacts();
        return view('admin.comments.contacts', compact('contacts'));
    }

    /**
     * @title 查看反馈内容
     * @param Comment $contacts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info( Comment $contacts)
    {
        if( $contacts->parentid != 0)
        {
            $contacts = Comment::where('id', $contacts->parentid)
                ->first();
        }
        $Feedback = Comment::where('parentid', $contacts->id )
           ->orderBy('id', 'asc')
           ->get();
        return view('admin.comments.info',compact( 'contacts', 'Feedback' ));
    }

    /**
     * @titel 删除反馈
     * @param Comment $contacts
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function cdelete( Comment $contacts )
    {
        $contacts->delete();

        Cache::forget('gcontacts');
        Cache::forget('CNew');
        return redirect('/admin/contacts');
    }

    /**
     * @title 回复反馈
     * @return mixed
     */
    public function reply()
    {
        $this->validate(\request(), [
            'contents' => 'required'
        ],[
            'contents.required' => '回复内容不能为空…'
        ]);
        return CommentLogic::reply();
    }

    /**
     * @title 查找信息所在分页页码
     * @param $comments
     * @return float|int
     */
    static function page( $comments ) {
        if( $comments->parentid ){
            $comments = Comment::where('id', $comments->parentid )->first();
        }
        $count = Comment::where('articleid', $comments->articleid )
            ->where('pid', 0)
            ->where('id', '>', $comments->id )
            ->count();
        $page = config('page.article_page');
        $pn = $count / $page;
        if( $pn >= 1) {
            $pn = ceil( $pn ) + 1 ;
        }
        return $pn;
    }
}
