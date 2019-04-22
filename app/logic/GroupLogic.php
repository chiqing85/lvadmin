<?php

namespace App\logic;

use App\AuthGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GroupLogic extends Model
{
    /**
     * @title 角色列表
     * @return mixed
     */
    static function get() {
        return Cache::rememberForever('group', function () {
                return AuthGroup::orderBy('id', 'asc')
                    ->get();
            });
    }

    /**
     * @title 创建角色
     * @return RedirectResponse
     */
    static function create() {
        $data = request()->all();
        $data['rules'] = implode(',', request('rules'));
        AuthGroup::create($data);
        Cache::forget('group');
        return back();
    }

    /**
     * @title 更新角色表
     * @param $callback
     * @return Redirector
     */
    static function up( $callback ) {
        $data = request()->all();
        $rules = request('rules');
        $data['rules'] = $rules ? implode(',', $rules ) : '';
        $data['status'] = request('status') ? request('status') : 0;
        $callback->update( $data );
        Cache::forget('group');
        return redirect('/admin/group');
    }
}
