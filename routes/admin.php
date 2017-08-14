<?php
Route::group(['prefix' => 'admin'], function () {
    //登录展示
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    //登录行为
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');

    Route::group(['middleware' => 'auth:admin'], function () {
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');
        //登出行为
        Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');
    });
});