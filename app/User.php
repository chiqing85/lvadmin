<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @fn 用户有那些角色
     * @return
     */
    public function group() {
        // 多对多关系
        return $this->belongsToMany('\App\AuthGroup', "auth_group_access", 'uid', 'group_id');
    }

    /**
     * @fn 判断是否有某个角色
     * @param $group
     * @return bool
     */
    public function isInRoles( $group ) {
        return !! $group->intersect($this->group)->count();
    }

    /**
     * @fn 给用户分配角色
     * @param $group
     * @return
     */
    public function assignRole( $group ) {
        return $this->group()->save($group );
    }

    /**
     * @fn 取消用户分配的角色
     * @param $group
     * @return int
     */
    public function deleteRort( $group ) {
        return $this->group()-> detach( $group );
    }

    /**
     * @fn 用户是否有权限
     * @param $permission
     */
    public function hasPermission ( $permission ) {
        //
    }
}
