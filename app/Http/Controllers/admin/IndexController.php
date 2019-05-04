<?php

namespace App\Http\Controllers\admin;

use App\logic\LinLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index() {
        $loginlog = LinLogic::getlist();
        $bdtj = $this->tongji();
        return view('admin.index.index', compact(['loginlog', 'bdtj']));
    }

    public function tongji() {
        $bdtj = Cache::remember('tongji', 60 * 60 * 24 , function () {
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
            $ip = $pv = $uv = '';
            foreach ($result['items'][1] as $k => $v) {
                $times = $result['items'][0][$k][0];
                $time = substr($times, strripos($times, '/') + 1 );
                $pv .= "['$time',$v[0]],";
                $uv .= "['$time',$v[1]],";
                $ip .= "['$time',$v[2]],";
            }
            function sub($str) {
                return substr($str,0,strlen($str)-1);
            }
            $arr = array(
                'pv' => sub( $pv),
                'uv' => sub( $uv),
                'ip' => sub( $ip)
            );
            return $arr;
        });
        return $bdtj;
    }
}
