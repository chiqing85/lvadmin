<?php

namespace App\Http\Controllers\admin;

use App\Article;
use App\logic\AClassLogic;
use App\logic\ArticleLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    protected $rule = array(
        'title' => 'required',
        'author' => 'required',
        'editor-html-code' => 'required'
    );
    /**
     * @title 文章列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $artic =  ArticleLogic::list();
        return view('admin.article.index', compact('artic'));
    }

    /**
     * @title 添加内容
     * @return View
     * @throws ValidationException
     */
    public function create() {
        if(request()->isMethod('get')) {
            $AClass = create( AClassLogic::get() );
            //  无限分类查询其是否有子类
            foreach ($AClass as $k => $v) {
                foreach ($AClass as $s)
                    if($v['id'] == $s['pid']) {
                        $v['h_layer'] = 1;
                        break;
                    } else {
                        $v['h_layer'] = 0;
                    }
            }
            return view('admin.article.create', compact('AClass'));
        } else {
            $this->validate(request(), $this->rule );
            return ArticleLogic::create();
        }
    }

    /**
     * @title 更新
     * @param Article $article
     * @return \App\logic\Redirector|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update( Article $article) {
        if(\request()->isMethod('get')) {
            $AClass = create( AClassLogic::get() );
            //  无限分类查询其是否有子类
            foreach ($AClass as $k => $v) {
                foreach ($AClass as $s)
                    if($v['id'] == $s['pid']) {
                        $v['h_layer'] = 1;
                        break;
                    } else {
                        $v['h_layer'] = 0;
                    }
            }
            return view('admin.article.update', compact('article', 'AClass'));
        } else {
            $this->validate(request(), $this->rule );
            return ArticleLogic::up( $article );
        }
    }

    /**
     * @title 更新字段
     * @param Article $article
     * @return false|string
     */
    public function edit( Article $article ) {
        return ArticleLogic::edit( $article );
    }

    /**
     * @title 单删除
     * @param Article $article
     * @return bool|null
     * @throws \Exception
     */
    public function delete( Article $article) {
        return ArticleLogic::deletel( $article );
    }

    /**
     * @title 多删除
     * @return mixed
     */
    public function deleteall() {
        return ArticleLogic::deleall( \request()->all() );
    }
}