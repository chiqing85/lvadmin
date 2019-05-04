<?php

namespace App\logic;

use App\Blacklist;
use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BlackLogic extends Model
{
    /**
     * @title 黑色单列表
     * @return mixed
     */
    static function getlist()
    {
        if( request('page') ) {
            Cache::forget('blacklist');
        }
        return Cache::remember('blacklist', 60, function () {
            return Blacklist::orderBy('id', 'desc')
                ->paginate( 15 );
        });
    }

    /**
     * @title 删除黑名单
     * @param $callback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    static function deletel( $callback )
    {
        Comment::where('ip', $callback->ip)
            ->where('status', '-1')
            ->update(['status'=> '1']);
        $callback->delete();
        Cache::forget('blacklist');
        Cache::forget('comms');
        return redirect( '/admin/blacklist');
    }
}
