<?php

namespace App\Http\Controllers\admin;

use App\Blacklist;
use App\logic\BlackLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlacklistController extends Controller
{
    /**
     * @title 黑名单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $black = BlackLogic::getlist();
        return view('admin.blacklist.index', compact('black'));
    }

    /**
     * @title 删除黑名单
     * @param Blacklist $black
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete( Blacklist $black )
    {
        return BlackLogic::deletel( $black );
    }
}
