<?php

namespace App\Http\Controllers\home;

use App\logic\CommentLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    protected $rules = [
        'name' => 'required|max:25',
        'email' => 'required|email',
        'url' => 'nullable|url',
        'contents' => 'required'
    ];
    protected $messages = [
      'name.required' => '昵称不可为空…',
      'name.max' => '昵称长度超过上限…',
      'email.required' => '请输入邮箱地址/回复将通过邮箱通知…',
      'email.email' => '邮箱格式有误…',
      'contents.required' => '内容不能为空…'
    ];
    /**
     * @title 反馈中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home.contacts.index');
    }

    /**
     * @title 反馈信息
     * @throws \Illuminate\Validation\ValidationException
     */
    public function contacts()
    {
        if( \request()->isMethod('post'))
        {
            $this->validate(\request(), $this->rules, $this->messages);
            return CommentLogic::contacts();
        }
    }

}
