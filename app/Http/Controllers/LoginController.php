<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function name()
    {
        return 'name';
    }

    //登录页面
    public function index()
    {
        return view('login/index');
    }

    //登录行为
    public function login()
    {
        //验证
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);

        //逻辑
        $user = request(['email', 'password']);
        $is_remember = boolval(request('is_remmeber'));
        if (\Auth::attempt($user, $is_remember)) {
            return redirect('/posts');
        }

        //渲染
        return \Redirect::back()->withInput()->withErrors('邮箱密码不匹配!');


//        $this->validate(request(), [
//            'name' => 'required',
//            'password' => 'required|min:5|max:10',
//            'is_remember' => 'integer'
//        ]);
//
//        $user = request(['name', 'password']);
//        $is_remember = boolval(request('is_remmeber'));
//        if (\Auth::attempt($user, $is_remember)) {
//            return redirect('/posts');
//        }
//
//        //渲染
//        return \Redirect::back()->withInput()->withErrors('账号密码不匹配!');
    }

    //登出行为
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
