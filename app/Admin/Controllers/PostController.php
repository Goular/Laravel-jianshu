<?php
namespace App\Admin\Controllers;

use App\Post;

class PostController extends Controller
{
    //后台文章管理展示页
    public function index()
    {
        $posts = Post::withoutGlobalScope('avaiable')->where('status', 0)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.post.index',compact('posts'));
    }

    //后台文章状态更改页面
    public function status()
    {
        //TODO:
    }
}