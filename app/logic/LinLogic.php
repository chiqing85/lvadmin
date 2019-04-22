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
            return  Loginlog::orderBy('id')
                ->with('user:id,username')
                ->paginate(15);
        });
    }
}
