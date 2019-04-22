<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\logic\ConfigLogic;

class ConfigController extends Controller
{
    /**
     * @title 读取系统配置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $config = ConfigLogic::get();
        return view('admin.config.index', compact( 'config' ));
    }

    /**
     * @title 更新
     * @param Request $request
     * @return mixed
     */
    public function update( Request $request) {
        return ConfigLogic::up( $request );
    }
}
