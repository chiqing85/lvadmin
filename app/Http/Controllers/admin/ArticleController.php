<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    // 文章列表
    public function index() {

        $value = Cache::remember('artic', 60, function () {
           return 'LvAdmin';
        });

         dd( Cache::get('artic') );

        return view('admin.article.index');
    }
}
