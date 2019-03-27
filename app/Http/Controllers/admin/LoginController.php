<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index() {
        return view('admin.login.index');
    }

    public function login() {

        // 登录验证
        $this->validate(request(), [
            'user'=> 'required|min:2|max:20',
            'password' => 'required|min:6',
            'captcha' => 'required|captcha',
            'is_remember' => 'integer'
        ]);

        // 逻辑判断
        $user = \request(['user', 'password']);
        $is_remember = boolval(\request(['is_remember']));
        if(\Auth::attempt($user, $is_remember)) {
            // 成功跳转
            return redirect('/admin');
        }

        return back();
    }
}
