<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function email()
    {
        dd( '邮箱设置');
    }

    public function tongji()
    {
        dd( '百度统计');
    }
}
