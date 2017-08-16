<?php
namespace App\Http\Controllers;

class NoticeController extends Controller
{
    public function index()
    {
        //获取当前用户
        $user = \Auth::user();
        $notices = $user->notices()->orderBy('created_at','desc')->get();

        return view('notice/index', compact('notices','user'));
    }
}