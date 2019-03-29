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

Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {
    // 首页
    Route::get('/', 'admin\IndexController@index');
    // 系统配置
    Route::get('/config', 'admin\ConfigController@index');

    // 用户
    Route::get('/users', 'admin\UsersController@index');

    // 角色
    Route::get('/group', 'admin\GroupController@index');

});