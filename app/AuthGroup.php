<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthGroup extends Model
{
    // 角色表
    protected $table = 'auth_group';

    // 当前角色的所有权限
    public function access () {
        // return $this->hasMany(\App\AuthGroupAccess::class,'group_id');
    }

    // 判断角色是否有权限
    public function hasPermission( $permission ) {
        return $this->permissions->contains( $permission );
    }
}
