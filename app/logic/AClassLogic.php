<?php

namespace App\logic;

use App\Aclass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AClassLogic extends Model
{
    static function get( ) {
        return Cache::rememberForever('AClass', function () {
            return Aclass::orderBy('sort', 'desc')
                ->get( ['id', 'name', 'dirs', 'mid','sort','pid', 'status'] );
        });
    }
}
