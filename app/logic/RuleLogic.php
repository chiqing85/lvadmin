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
        return back();
    }

    static function up( $callback) {
        $callback->update( request()->all() );
        Cache::forget('rule');
        return redirect('/admin/rule');
    }
}
