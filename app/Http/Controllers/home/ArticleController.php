<?php

namespace App\Http\Controllers\home;

use App\Article;
use App\Comment;
use App\logic\ArticleLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index() {
        $article = ArticleLogic::homelist();
        return view('home.article.index', compact('article'));
    }

    /**
     * @title 文章内容页
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article) {
        $article->increment('number');
        $comment = $article
            ->comment()
            ->where('pid', 0)
            ->whereIn('status', [1, 0])
            ->orderBy('id', 'desc')
            ->paginate( config('page.article_page') );
        $article['keywords'] = explode(',', $article['keywords']);
       return view('home.article.show', compact('article', 'comment'));
    }

    /**
     * @title 楼中楼
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    static function lzl( $id ) {
        $comment = Comment::where('parentid', $id )
            ->whereIn('status', [1, 0])
            ->orderBy('id', 'asc')
            ->simplePaginate( 5, ['*'], 'spage' );
        $comment->withPath("article/lzl/$id");
        return view( 'home.layouts.lzl',compact('comment'));
    }

    /**
     * @title 关于我
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        $article = ArticleLogic::about();
        return view('home.article.about', compact('article'));
    }

    /**
     * @title 文章归档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function archives()
    {
        $article = Article::whereHas( 'aclass', function( $query ) {
                $query->where('mid', 0);
            })
            ->groupBy('created_at', 'id', 'title', 'content')
            ->selectRaw(
                'FROM_UNIXTIME(UNIX_TIMESTAMP(created_at),"%Y") as stime,id,title,created_at,content'
            )
            ->orderBy('created_at', 'desc')
            ->get();
        $arr = array();
        foreach ($article as $k => $v )
        {
            $arr[ $v['stime']][] = $v;
        }
        return view('home.article.archives', compact('arr'));
    }
}
