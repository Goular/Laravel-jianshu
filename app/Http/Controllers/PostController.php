<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表
    public function index()
    {
        $posts = array(
            ['title' => '这是标题001'],
            ['title' => '这是标题011'],
            ['title' => '这是标题111'],
            ['title' => '这是标题002'],
            ['title' => '这是标题022'],
            ['title' => '这是标题222'],
            ['title' => '这是标题003']
        );
        $topics = ['id' => '00897442'];
        return view('post/index', compact('posts', 'topics'));
    }

    //详情页面
    public function show()
    {
        return view('post/show', ['title' => '这是标题1', 'isShow' => true]);
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
