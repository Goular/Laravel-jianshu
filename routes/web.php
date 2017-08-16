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

/*************** 根目录模块 *******************/
Route::get('/', function () {return view('welcome');});
/*************** 根目录模块 *******************/

/*************** 登录模块 *******************/
//注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
//登录页面
Route::get('/login', '\App\Http\Controllers\LoginController@index');
//登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
/*************** 登录模块 *******************/


/*************************** 默认模块,登陆后访问的模块 *****************************/
Route::group(['middleware' => 'auth'], function () {
    //*********************************用户模块*********************************
    //登出行为
    Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
    //个人中心
    Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
    Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
    Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');
    Route::post('/user/{user}/star', '\App\Http\Controllers\UserController@star');
    Route::post('/user/{user}/unstar', '\App\Http\Controllers\UserController@unstar');

    //个人设置页面
    Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
    //个人设置操作
    Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');
    //*********************************用户模块*********************************

    //*********************************文章模块*********************************
    //文章列表
    Route::get('/posts', '\App\Http\Controllers\PostController@index');
    //创建文章
    Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
    Route::post('/posts', '\App\Http\Controllers\PostController@store');
    //编辑文章
    Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
    Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
    //删除文章
    Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
    //搜索文章
    Route::get('/posts/search', '\App\Http\Controllers\PostController@search');
    //文章详情
    Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
    //*********************************文章模块*********************************

    //*********************************图片上传模块*********************************
    Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpLoad');
    //*********************************图片上传模块*********************************

    //*********************************专题模块*********************************
    //专题详情页
    Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
    Route::post('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');
    //*********************************专题模块*********************************

    //*********************************评论模块*********************************
    //提交评论
    Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
    //点赞
    Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
    //取消点赞
    Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');
    //*********************************评论模块*********************************

    //*********************************通知模块*********************************
    Route::get('/notices', '\App\Http\Controllers\NoticeController@index');
    //*********************************通知模块*********************************
});
/*************************** 默认模块,登陆后访问的模块 *****************************/

include_once('admin.php');