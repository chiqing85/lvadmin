<?php

namespace App\logic;

use App\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ConfigLogic extends Model
{
    /**
     * @title 获取网站信息
     * @return mixed
     */
    static function get() {
        return Cache::rememberForever('config', function () {
            return Config::where('status', 1)
                ->orderBy( 'sorts')
                ->get();
        });
    }

    /**
     * @title 修改网站信息
     * @param $callback
     * @return RedirectResponse
     */
    static function up( $callback )
    {
        $num = 0;
        foreach ( $callback->all() as $k => $v) {
            if( $v !== null ) {
                Config::where('k', $k)
                    ->update(['v' => $v ]);
                $num ++ ;
            }
        }
        if( $num != 0) {
            Cache::forget('config');
            return back();
        } else {
            return redirect()->back()->withErrors('没有更改任何值…');
        }
    }
}
