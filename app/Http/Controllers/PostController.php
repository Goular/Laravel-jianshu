<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    //详情页面
    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    //创建页面
    public function create()
    {
        return view('post/create');
    }

    //创建逻辑
    public function store()
    {
        //验证
        $this->validate(request(), array(
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ));
        //写入到数据表
        $post = Post::create(request(['title', 'content']));
        //转跳到消息列表的页面
        return redirect("/posts");
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
