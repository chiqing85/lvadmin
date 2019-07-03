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
Route::get('/article', 'home\ArticleController@index');
Route::get('/archives', 'home\ArticleController@archives');
Route::get('/about', 'home\ArticleController@about');
Route::get('/contacts', 'home\ContactsController@index');
Route::get('/article/lzl/{id}', 'home\ArticleController@lzl');
Route::get('/link', 'home\LinkController@index');
Route::get('/article/{article}', 'home\ArticleController@show');
Route::group(['prefix' => 'comments'], function() {
    Route::post('/article', 'home\CommentsController@article');
    Route::post('/contacts', 'home\ContactsController@contacts');
});
Route::get('/categories/{str}', 'home\CategoriesController@list');

/**
 * @title 后台路由
 */
Route::get('/login', 'admin\LoginController@index')->name('login');
Route::post('/login', 'admin\LoginController@login');
Route::group(
    [ 'prefix' => 'admin',
               'middleware' => ['auth:web', 'check']
             ], function () {
    // 首页
    Route::get('/', 'admin\IndexController@index');
    // 个人资料
    Route::get('/account/infop/', 'admin\AccountController@infop');
    Route::post('/account/update', 'admin\AccountController@update');
    Route::get('/account/pwd', 'admin\AccountController@pwd');
    Route::post('/account/uppwd', 'admin\AccountController@uppwd');

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
    Route::match(['get', 'post'], '/users/update/{Users}', 'admin\UsersController@update');
    Route::get('/users/delete/{Users}', 'admin\UsersController@delete');
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
    Route::match(['get', 'post'], '/article/create', 'admin\ArticleController@create');
    Route::match(['get', 'post'], '/article/update/{article}', 'admin\ArticleController@update');
    Route::post('/article/edit/{article}', 'admin\ArticleController@edit');
    Route::get('/article/delete/{article}', 'admin\ArticleController@delete');
    Route::post('/article/delete', 'admin\ArticleController@deleteall');

    // 文章分类列表
    Route::get('/aclass', 'admin\AclassController@index');
    Route::match(['get', 'post'], '/aclass/create', 'admin\AclassController@create');
    Route::match(['get', 'post'], '/aclass/create/{id}', 'admin\AclassController@create');
    Route::match(['get', 'post'], '/aclass/update/{aclass}', 'admin\AclassController@update');
    Route::get('/aclass/delete/{Aclass}', 'admin\AclassController@delete');

    Route::get('/tags',function () {
       return redirect()->back()->withErrors('该功能暂未开发……');
    });

    // 文章评论列表
    Route::get('/comments', 'admin\CommentsController@index');
    Route::post('/comments/black/{comment}', 'admin\CommentsController@black');
    Route::post('/comments/review/{comment}', 'admin\CommentsController@review');
    Route::get('/comments/delete/{comment}', 'admin\CommentsController@delete');
    Route::post('/comments/delete', 'admin\CommentsController@deleteall');
    Route::get('/comments/recycle', 'admin\CommentsController@recycle');

    //  - 回收站
    Route::get('/comments/rleupd/{comment}','admin\CommentsController@rleupd');
    Route::get('/comments/rledel/{comment}', 'admin\CommentsController@rledel');
    Route::post('/comments/rledel', 'admin\CommentsController@rledelall');
    Route::get('/comments/empty', 'admin\CommentsController@empty');
    // 反馈中心
    Route::get('/contacts', 'admin\CommentsController@contacts');
    Route::get('/contacts/info/{contacts}', 'admin\CommentsController@info');
    Route::post('/contacts/reply', 'admin\CommentsController@reply');
    Route::get('/contacts/delete/{contacts}', 'admin\CommentsController@cdelete');

    // 黑名单
    Route::get('/blacklist', 'admin\BlacklistController@index');
    Route::get('/blacklist/delete/{black}','admin\BlacklistController@delete');

    // 配置管理
    Route::get('/email', 'admin\SettingController@email');
    Route::get('/tongji', 'admin\SettingController@tongji');


    // 上传文件
    Route::post('/upload/image', 'admin\UploadController@image');
    Route::post('/upload/thumb', 'admin\UploadController@thumb');
    Route::post('/upload/editor', 'admin\UploadController@editor');

    // 退出登录
    Route::get('/logout', 'admin\LoginController@logout');

    // 最新通知
    Route::get('/notices/noticesall', 'admin\NoticesController@noticesall');
    Route::any('/pusher_auth', 'admin\NoticesController@pusher');
});