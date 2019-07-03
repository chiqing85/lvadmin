<?php

namespace App\Http\Controllers\home;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {


        $bg = $this->bing();
        return view('home.index.index', compact('title', 'bg'));
    }

    public function bing()
    {
        Cache::forget('bing');

        return Cache::remember('bing', 60 * 60 * 24 ,function( $https = true,$method='get',$data=null ) {
            $ch = curl_init(); //初始化
            $curl = 'https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1';
            curl_setopt($ch, CURLOPT_URL, $curl);
            curl_setopt($ch, CURLOPT_HEADER, false);//设置不需要头信息
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//获取页面内容，但不输出

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//不做服务器认证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//不做客户端认证

            $str = curl_exec($ch);//执行访问
            curl_close($ch);//关闭curl，释放资源
            $str = json_decode($str, true);
            if ($str == null) {
                return 'https://cn.bing.com/az/hprichbg/rb/Kamakura_EN-CN6570210852_1920x1080.jpg';
            }
            $url = $str['images'][0]['url'];
            $bing = "/^https:\/\/s\.cn\.bing\.net/";
            if (preg_match($bing, $url)) {
                return $url;
            } else {
                return "https://www.bing.com" . $url;
            }
        });
    }
}
