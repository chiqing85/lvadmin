<?php

namespace App\Http\Controllers\admin;

use App\logic\LinLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginLogController extends Controller
{
    /**
     * @title 读取登录日志
     * @return View
     */
    public function index() {
        $loginlog = LinLogic::get();
        return view('admin.loginlog.index', compact('loginlog'));
    }
}
