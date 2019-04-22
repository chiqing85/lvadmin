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


/**
 * @title 后台路由
 */
Route::get('/login', 'admin\LoginController@index')->name('login');
Route::post('/login', 'admin\LoginController@login');

Route::group([ 'prefix' => 'admin',
               'middleware' => ['auth:web', 'check']
             ], function () {
    // 首页
    Route::get('/', 'admin\IndexController@index');
    Route::get('/tongji', 'admin\IndexController@tongji');
    // 系统配置
    Route::get('/config', 'admin\ConfigController@index');
    Route::get('/config/update', 'admin\ConfigController@update');
    // 登录日志
    Route::get('/login_log', 'admin\LoginLogController@index');
    // 友链
    Route::get('/links', 'admin\LinksController@index');
    Route::match(['get', 'post'], '/links/create', 'admin\LinksController@create');
    Route::match(['get', 'post'], '/links/update/{link}', 'admin\LinksController@update');
    Route::get('/links/delete/{id}', 'admin\LinksController@delete');
    // 清空缓存
    Route::get('/cache', 'admin\CacheController@index');
    // 用户
    Route::get('/users', 'admin\UsersController@index');
    Route::match(['get', 'post'], '/users/create', 'admin\UsersController@create');
    // 角色
    Route::get('/group', 'admin\GroupController@index');
    Route::match(['get', 'post'], '/group/create', 'admin\GroupController@create');
    Route::match(['get', 'post'], '/group/update/{group}', 'admin\GroupController@update');
    Route::get('/group/delete/{group}', 'admin\GroupController@delete');

    // 权限节点
    Route::get('/rule', 'admin\RuleController@index');
    Route::match(['get', 'post'], '/rule/create', 'admin\RuleController@create');
    Route::match(['get', 'post'], '/rule/update/{authRule}', 'admin\RuleController@update');
    Route::get('/rule/delete/{AuthRule}', 'admin\RuleController@delete');

    // 文章管理列表
    Route::get('/article', 'admin\ArticleController@index');
    // 文章分类列表
    Route::get('/aclass', 'admin\AclassController@index');
    Route::match(['get', 'post'], '/aclass/create', 'admin\AclassController@create');
    Route::match(['get', 'post'], '/aclass/create/{id}', 'admin\AclassController@create');
    Route::match(['get', 'post'], '/aclass/update/{aclass}', 'admin\AclassController@update');

    Route::get('/aclass/delete/{Aclass}', 'admin\AclassController@delete');
    // 文章评论列表
    Route::get('/comments', 'admin\CommentsController@index');

    // 上传文件
    Route::post('/upload/image', 'admin\UploadController@image');

});