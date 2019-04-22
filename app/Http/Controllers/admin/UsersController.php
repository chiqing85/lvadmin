<?php

namespace App\Http\Controllers\admin;

use App\logic\GroupLogic;
use App\logic\UsersLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @title 用户列表
     * @return View
     */
    public function index() {
        $user =  UsersLogic::userlist();
        return view('admin.users.index', compact('user'));
    }

    /**
     * @title 添加用户
     * @return View
     */
    public function create() {
        if(request()->isMethod('get')) {
            $group = GroupLogic::get();
            return view('admin.users.create', compact('group'));
        } else {

        }
    }
}
