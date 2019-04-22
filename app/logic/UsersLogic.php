<?php

namespace App\logic;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UsersLogic extends Model
{
    /**
     * @title 管理员列表
     * @return mixed
     */
    static function userlist() {
        return Cache::rememberForever('userlist', function () {
            return User::orderBy('id')
                ->with('group:id,title')
                ->get(['id', 'username', 'pic', 'created_at', 'status']);
        });
    }
}
