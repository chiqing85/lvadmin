<?php

namespace App\Http\Controllers\admin;

use App\AuthGroup;
use App\logic\GroupLogic;
use App\logic\RuleLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class GroupController extends Controller
{
    /**
     * @title 角色列表
     * @return View
     */
    public function index() {
        $group = GroupLogic::get();
        return view('admin.group.index', compact('group'));
    }

    /**
     * @title 创建角色
     * @return View
     */
    public function create() {
        if( request()->isMethod('get') ) {
            $rule = create( RuleLogic::get() );
            return view('admin.group.create', compact('rule'));
        } else {
            return GroupLogic::create();
        }
    }

    /**
     * @title 授予角色相应权限
     * @param AuthGroup $group
     * @return View
     */
    public function update( AuthGroup $group) {
        if( request()->isMethod('get')) {
            $rule = create( RuleLogic::get() );
            return view('admin.group.update', compact(['rule', 'group']));
        } else {
            return GroupLogic::up( $group );
        }
    }

    /**
     * @title 删除角色
     * @param AuthGroup $group
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(AuthGroup $group) {
        $group->delete();
        Cache::forget('group');
        return back();
    }
}
