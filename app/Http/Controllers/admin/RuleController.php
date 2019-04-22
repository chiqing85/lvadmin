<?php

namespace App\Http\Controllers\admin;

use App\AuthRule;
use App\logic\RuleLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class RuleController extends Controller
{
    /**
     * @title 验证
     * @var array
     */
    protected $rule = array(
        'title' => 'required',
        'menu' => 'integer',
        'status' => 'integer'
    );

    /**
     * @title 权限节点
     * @return View
     */
    public function index() {
        $rule = RuleLogic::get();
        $rule['items'] = create( $rule );
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
             $rule = create( RuleLogic::get() );
            return view('admin.rule.create', compact('rule') );
        } else {
             $this->validate($request, $this->rule);
             Cache::forget('rule');
             return RuleLogic::create();
        }
    }

    public function update(AuthRule $authRule) {
        if( request()->isMethod('get')) {
            $rule = create( RuleLogic::get() );
            return view('admin.rule.update', compact( [ 'authRule', 'rule'] ));
        } else {
            $this->validate( request(), $this->rule);
            return RuleLogic::up( $authRule );
        }
    }

    /**
     * @title 删除节点
     * @param AuthRule $AuthRule
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete( AuthRule $AuthRule) {
        $AuthRule->delete();
        Cache::forget('rule');
        return back();
    }

}
