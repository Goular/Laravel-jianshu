<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //导航栏统一登录显示页面
        \View::composer('layout.nav', function($view){
            $user = \Auth::user();
            $view->with('user', $user);
            \Log::debug('User',compact('user'));
        });

        //
        \View::composer('layout.sidebar', function ($view) {
            //返回回来的$View,就是'layout.sidebar'
            $topics = \App\Topic::all();
            $view->with('topics', $topics);
        });

        \DB::listen(function ($query) {
            $sql = $query->sql;
            //PDO预处理需要绑定的对象
            $binding = $query->bindings;
            $time = $query->time;
            //var_export -- 输出或返回一个变量的字符串表示
            \Log::debug('SQL查询详情',compact('sql', 'binding', 'time'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
