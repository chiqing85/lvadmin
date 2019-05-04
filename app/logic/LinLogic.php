<?php

namespace App\logic;

use App\Loginlog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LinLogic extends Model
{
    /**
     * @title 登录日志
     * @return mixed
     */
    static function get( ) {
        $page = request('page') ? request('page') : 1;
        return Cache::remember('loginlog'. $page, 60,  function() {
            return  Loginlog::orderBy('id', 'desc')
                ->with('user:id,username')
                ->paginate(12);
        });
    }

    /**
     * @title 登录日志7条结果集
     * @return mixed
     */
    static function getlist() {
        return Cache::remember('getlist', 60,  function() {
            return  Loginlog::orderBy('id', 'desc')
                ->with('user:id,username')
                ->limit( 8 )
                ->get();
        });
    }
}
