<?php

namespace App\Http\Controllers\home;

use App\logic\CommentLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    protected $rull = array(
      'contents' => 'required',
      'name' => 'nullable|max:25',
      'email' => 'nullable|email',
      'url' => 'nullable|url'
    );

    /**
     * @title 添加评论
     * @return false|string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function article() {
        $this->validate(\request(), $this->rull );
        return CommentLogic::create();
    }
}
