<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    // 角色列表
    public function index() {
        $group = \App\AuthGroup::orderBy('id', 'asc')
               ->get();
        return view('admin.group.index', compact('group'));
    }

    // 创建角色

    // 创建角色行为

    // 角色权限页面

    // 更改角色权限
}
