<?php

namespace App\Http\Controllers\home;

use App\logic\ArticleLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * @title 文章分类列表页
     * @param $str
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list( $str) {
        $article = ArticleLogic::Categories( $str );
        return view('home.article.index', compact('article'));
    }
}
