<?php

namespace App\logic;

use App\Link;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LinkLogic extends Model
{
    /**
     * @title 读取友链列表
     * @return mixed
     */
    static function get() {
        if( request('page') ) {
            Cache::forget('getlink');
        }
        return Cache::rememberForever('getlink',  function () {
            return  Link::orderBy('sorts', 'asc')
                ->orderBy('id', 'asc')
                ->paginate( 12 );
        });
    }

    /**
     * @title 添加友链
     * @param $callback
     * @return Redirector
     */
    static function create( $callback ) {
        $data = $callback->all();
        Link::create( $data );
        Cache::forget('getlink');
        return redirect('/admin/links');
    }

    /**
     * @title 更新友链信息
     * @param $callback
     * @return Redirector
     */
    static function up ( $callback ) {
        $data = request(['link_name', 'link_url', 'email', 'sorts', 'status']);
        $data['status'] = request('status') ? request('status') : 0;
        $callback->update($data);
        Cache::forget('getlink');
        return redirect('/admin/links');
    }

    static function getlist()
    {
        return Cache::rememberForever('link',  function () {
            return  Link::where('status', 1)
                ->orderBy('sorts', 'asc')
                ->orderBy('id', 'asc')
                ->limit( 10 )
                ->get();
        });
    }
}
