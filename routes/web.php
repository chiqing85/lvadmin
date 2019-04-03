<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'home\IndexController@index');

Route::get('/login', 'admin\LoginController@index')->name('login');
Route::post('/login', 'admin\LoginController@login');

Route::group([ 'prefix' => 'admin',
               'middleware' => ['auth:web', 'check']
             ], function () {
    // 首页
    Route::get('/', 'admin\IndexController@index');
    // 系统配置
    Route::get('/config', 'admin\ConfigController@index');
    Route::get('/links', 'admin\LinksController@index');

    // 用户
    Route::get('/users', 'admin\UsersController@index');

    // 角色
    Route::get('/group', 'admin\GroupController@index');

    // 权限节点
    Route::get('/rule', 'admin\RuleController@index');
    Route::match(['get', 'post'], '/rule/create', 'admin\RuleController@create');
    Route::get('/rule/update/{authRule}', 'admin\RuleController@update');
    Route::get('/rule/delete/{AuthRule}', 'admin\RuleController@delete');

    // 文章管理列表
    Route::get('/article', 'admin\ArticleController@index');
    // 文章分类列表
    Route::get('/aclass', 'admin\AclassController@index');
    Route::match(['get', 'post'], '/aclass/create', 'admin\AclassController@create');
    // 文章评论列表
    Route::get('/comments', 'admin\CommentsController@index');


});