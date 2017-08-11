<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    public function show()
    {
        $user = \Auth::user();
        return view('topic/show', compact('user'));
    }

    public function submit(Topic $topic)
    {
        return;
    }
}
