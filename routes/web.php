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

Route::get('/', function () {
    return redirect('admin/logins');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //登录页面
    Route::match(['get','post'],'logins','IndexController@login')->name('logins');
    //登录逻辑
    Route::post('handle','IndexController@handle')->name('handle');
    //用户注册
    Route::any('added','IndexController@added')->name('added');
    //忘记密码
    Route::match(['get','post'],'forget','IndexController@forget')->name('forget');
    //重置密码
    Route::post('resetpassword','IndexController@reset');
    //后台首页
    Route::get('homes','HomesController@index');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
