<?php

namespace App\Http\Controllers\admin;

use App\Link;
use App\logic\LinkLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class LinksController extends Controller
{
    protected $rule = array(
        'link_name' => 'required',
        'link_url' => 'required|url'
    );
    /**
     * @title 友情链接
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $link = LinkLogic::get();
        return view('admin.link.index', compact('link'));
    }

    /**
     * @title 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create( Request $request) {

        if( $request->isMethod('get') ) {
            return view('admin.link.create');
        } else {
            $this->validate($request, $this->rule );
            return LinkLogic::create( $request );
        }
    }

    /**
     * @title 更新
     * @param Link $link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Link $link) {
        if(\request()->isMethod('get')) {
            return view('admin.link.update', compact('link'));
        } else {
            $this->validate( request(),  $this->rule );
            return LinkLogic::up( $link );
        }
    }

    /**
     * @title 删除友链
     * @param Link $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Link $id) {
        $id->delete();
        Cache::forget( 'getlink');
        return back();
    }
}
