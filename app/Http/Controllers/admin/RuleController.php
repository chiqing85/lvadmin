<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuleController extends Controller
{
    // 节点展显

    public function index() {
        $rule = \App\AuthRule::orderBy('sort', 'desc')
              ->get();

        return view('admin.rule.index', compact('rule'));
    }

    // 添加新节点
    public function create() {
        return view('admin.rule.create');
    }

    // 删除节点


}
