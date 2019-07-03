<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function index() {
        return view('admin.login.index');
    }

    public function login() {
        // 登录验证
        $this->validate(request(), [
            'username'=> 'required|min:2|max:20',
            'password' => 'required|min:6',
            'captcha' => 'required|captcha',
            'is_remember' => 'integer'
        ]);

        // 逻辑判断
        $user = \request(['username', 'password']);
        $is_remember = boolval(\request(['is_remember']));
        if(\Auth::attempt($user, $is_remember)) {
            $data = array (
                'uid' => Auth::id(),
                'ip' => request()->getClientIp(),
                'location' => Getiplookup( request()->getClientIp() )
            );
            \App\Loginlog::create( $data );
            // 成功跳转
            Cache::forget('getlist');
            return redirect('/admin');
        }
        return redirect()->back()->withErrors('用户名或密码错误');
    }

    // 退出登录
    public function logout() {
        \Auth::logout();
        return redirect('/login');
    }
}
