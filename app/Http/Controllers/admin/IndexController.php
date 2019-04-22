<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;

class IndexController extends Controller
{
    public function index() {
        return view('admin.index.index');
    }

    public function tongji() {
        $today = date('Ymd');
        $yesterday = date('Ymd', strtotime(date('Ym01'), $today));
        $baiduTongji = resolve('BaiduTongji');

        $result = $baiduTongji->getData([
            'method' => 'trend/time/a',
            'start_date' =>  $yesterday,
            'end_date' => $today,
            'metrics' => 'pv_count,visitor_count, ip_count',
            'max_results' => 0,
            'gran' => 'day',
        ]);
        return $result;
    }
}
