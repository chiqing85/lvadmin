<?php

namespace App\Http\Controllers\admin;

use App\AuthRule;
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

    /**
     * @title 添加新节点
     * @param Request $request
     * @return
     * @throws
     */
    public function create(Request $request) {

         if( $request->isMethod('get') ) {
            return view('admin.rule.create');
        } else {
             $this->validate($request, [
                'title' => 'required',
                 'name' => 'required',
                 'status' => 'integer'
             ]);
             $params = request(['title', 'name', 'pid', 'status']);
             AuthRule::create( $params );
             return back();
        }
    }

    public function update(AuthRule $authRule) {
        return view('admin.rule.update', compact('authRule'));
    }

    /**
     * @title 删除节点
     * @param AuthRule $AuthRule
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete( AuthRule $AuthRule) {
        $AuthRule->delete();
        return back();
    }

}
