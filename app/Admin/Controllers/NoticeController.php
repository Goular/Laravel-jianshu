<?php
namespace App\Admin\Controllers;

use App\Notice;
use App\Topic;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = \App\Notice::all();
        return view('admin/notice/index', compact('notices'));
    }

    public function create()
    {

        return view('admin/notice/add');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $title = request('title');
        $content = request('content');

        $notice = \App\Notice::create(compact('title', 'content'));

        //分发队列任务到队列中
        dispatch(new \App\Jobs\SendMessage($notice));

        return redirect('/admin/notices');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}