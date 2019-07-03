<?php

namespace App\logic;

use App\AuthRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class RuleLogic extends Model
{
    static function get() {
        return  Cache::rememberForever('rule', function () {
            return AuthRule::orderBy('sorts', 'desc')
                    ->get();
        });
    }

    static function create() {
        $params = request()->all();
        AuthRule::create( $params );
        Cache::forget('rule');
        Cache::forget('adminAside');
        return back();
    }

    static function up( $callback) {
        $callback->update( request()->all() );
        Cache::forget('rule');
        Cache::forget('adminAside');
        return redirect('/admin/rule');
    }

    static function aside()
    {
        return Cache::rememberForever('adminAside', function () {
            $aside = AuthRule::where('menu','0')
                ->where('status', '1')
                ->orderBy('sorts', 'desc')
                ->orderBy('id', 'asc')
                ->get(['id', 'pid', 'name', 'title', 'icon', ] );

            return self::unlinlist( $aside);
        });
    }
    static function unlinlist($data, $pid = 0){
        $arr = array();
        foreach ($data as $v) {
            if($v['pid'] ==$pid){
                $v['level'] = self::unlinlist($data, $v['id']);
                $arr[] = $v;
            }
        };
        return $arr;
    }
}
