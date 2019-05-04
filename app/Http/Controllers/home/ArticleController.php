<?php

namespace App\Http\Controllers\home;

use App\Article;
use App\logic\ArticleLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index() {
        $article = ArticleLogic::homelist();
        return view('home.article.index', compact('article'));
    }

    public function show(Article $article) {
        $comment = $article
            ->comment()
            ->whereIn('status', [1, 0])
            ->orderBy('id', 'desc')
            ->paginate(12);
        $comment = create( $comment );
        $article['keywords'] = explode(',', $article['keywords']);
       return view('home.article.show', compact('article', 'comment'));
    }
}
