<?php

namespace App\Http\Controllers\admin;

use App\Comment;
use App\logic\CommentLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
