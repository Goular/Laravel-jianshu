<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表
    public function index()
    {
        return view('post/index');
    }

    //详情页面
    public function show()
    {
        return view('post/show');
    }

    //创建页面
    public function create()
    {
        return view('post/create');
    }

    //创建逻辑
    public function store()
    {

    }

    //编译页面
    public function edit()
    {
        return view('post/edit');
    }

    //编译逻辑
    public function update()
    {

    }

    //删除逻辑
    public function delete()
    {

    }
}
