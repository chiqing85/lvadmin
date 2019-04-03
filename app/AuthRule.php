<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthRule extends Model
{
    protected $table = 'auth_rule';
    // 不可以注入的数据
     protected $guarded = [];
}
