<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $guarded = [];

    public function aclass() {
        return $this->hasOne('\App\Aclass', 'id', 'pid');
    }

    public function comment() {
        return $this->hasMany('\App\Comment', 'articleid', 'id');
    }
}
