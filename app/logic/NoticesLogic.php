<?php

namespace App\logic;

use App\Notice;
use Illuminate\Database\Eloquent\Model;

class NoticesLogic extends Model
{
    static function wall()
    {
        return Notice::where('user_id', \Auth::user()->id )
            ->orderBy('id', 'desc')
            ->get();
    }
}
