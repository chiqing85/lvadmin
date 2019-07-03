<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\Comment;
use App\Events\NewComments;
use App\logic\CommentLogic;
use App\logic\LinLogic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $today_start;

    public function __construct()
    {
        $this->today_start = date('Y-m-d');
    }
    public function index()
    {
        $acount = $this->acount();          // 文章统计
        $acountd = $this->acountd();        // 今日新增文章
        $ccount = $this->ccount();          // 留言统计
        $ccountd = $this->ccountd();        // 今日留言
        $loginlog = LinLogic::getlist();    // 日志
        $bdtj = $this->tongji();            // 统计
        $CNew = CommentLogic::new();        // 最新留言
        $system = $this->System();          // 服务器运行环境
        $copy = $this->copy();              // 版权信息
        return view('admin.index.index', compact(['loginlog', 'bdtj', 'CNew', 'system', 'copy', 'acount', 'acountd', 'ccount', 'ccountd']));
    }

    /**
     * @title 百度统计
     * @return mixed
     */
    public function tongji() {
        return Cache::remember('tongji', 6 * 60 * 60 , function () {
            $today = date('Ymd');
            $fm = date('m', strtotime( date('Y').'-'.( date('m') - 1). '-01') );
            $yesterday = date("Ym01",strtotime(date('Y').'-'.(date('m') -1).'-01'));
            $baiduTongji = resolve('BaiduTongji');
            $result = $baiduTongji->getData([
                'method' => 'trend/time/a',
                'start_date' =>  $yesterday,
                'end_date' => $today,
                'metrics' => 'pv_count',
                'max_results' => 0,
                'gran' => 'day',
            ]);

            $t = [];
            $month = '';
            $LastMonth = '';
            foreach ($result['items'][1] as $k => $v) {
                if( $v[0] == '--') $v[0] = '0';
                $times = $result['items'][0][$k][0];
                $time = substr($times, strripos($times, '/') + 1 );
                if( !in_array($time, $t) ) array_push($t, intval( $time ) );
                if( date('m') == substr(strstr($times, '/'), 1 , -3) ) {
                    $month = $v[0] . ',' . $month;
                } else {
                    $LastMonth = $v[0] . ',' . $LastMonth;
                }
            }
            sort($t );
            $LastMonth = sub( $LastMonth );
            $month = sub( $month );
            $xAxis = implode(',', $t);
            return array(
                'xAxis' => $xAxis,
                'pv' => [
                    $fm => $LastMonth,
                    date('m') => $month
                ]
            );
        });
    }

    /**
     * @title 服务器环境
     * @return mixed
     */
    public function System()
    {
        return Cache::rememberForever('ststem', function () {
            return [
                ['name' => '操作系统', 'value' => PHP_OS],
                ['name' => 'PHP版本', 'value' => phpversion()],
                ['name' => 'Mysql版本', 'value' => DB::selectOne("select version() as version;")->version ],
                ['name' => '运行环境', 'value' => substr($_SERVER['SERVER_SOFTWARE'],0,13)],
                ['name' => '框架版本', 'value' => 'Laravel '.app()::VERSION ],
                ['name' => 'gzip支持', 'value' => Extension_Loaded('zlib') ? 'YSE' : 'NO'],
                ['name' => '最大上传限制', 'value' => @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown']
            ];
        });
    }

    /**
     * @title 版权信息
     * @return mixed
     */
    public function copy()
    {
        return Cache::rememberForever('copy', function () {
            return require("json/copy.php");
        });
    }

    /**
     * @title 文章统计
     * @return mixed
     */
    public function acount()
    {
         return Article::count();
    }

    /**
     * @titel 今日新增文章
     * @return mixed
     */
    public function acountd()
    {
        return Article::where('created_at', '>', $this->today_start)->count();
    }

    /**
     * @title 留言统计
     * @return mixed
     */
    public function ccount()
    {
        return Comment::count();
    }

    /**
     * @title 今日统计
     * @return mixed
     */
    public function ccountd()
    {
        return Comment::where('created_at', '>', $this->today_start)->count();
    }
}
