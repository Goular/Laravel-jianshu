<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表
    public function index(\Psr\Log\LoggerInterface $log)
    {
//        $app = app();//获取容器
//        $log = $app->make('log');//获取容器类
//        $log->info("post_index",['data'=>"this is post index!"]);

//        $log->info("post_index",['data'=>"this is post index2!"]);

        //使用别名
//        \Log::info("post_index", ['data' => "this is post index3!"]);

        //$user = \Auth::user();

        //预加载方法1:
        //$posts = Post::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->with('user')->paginate(6);

        //预加载方法2:
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(6);
        $posts->load('user');

        return view('post/index', compact('posts'));
    }

    //详情页面
    public function show(Post $post)
    {
        $post->load('comments');
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

        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        //写入到数据表
        $post = Post::create($params);
        //转跳到消息列表的页面
        return redirect("/posts");
    }

    //编译页面
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    //编译逻辑
    public function update(Post $post)
    {
        //验证
        $this->validate(request(), array(
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:30'
        ));

        $this->authorize('update', $post);

        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();


        //渲染
        return redirect("/posts/{$post->id}");
    }

    //删除逻辑
    public function delete(Post $post)
    {
        // TODO:用户的权限体验
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('posts');
    }

    //上传图片
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

    //提交评论
    public function comment(Post $post)
    {
        //校验数据
        $this->validate(request(), [
            'content' => 'required|min:3'
        ]);

        //逻辑处理
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        //渲染
        return back();
    }

    //点赞
    public function zan(Post $post)
    {
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id
        ];
        $zan = Zan::firstOrCreate($params);
        return back();
    }

    //取消点赞
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    //文章搜索
    public function search()
    {
        //验证
        $this->validate(request(), [
            'query' => 'required'
        ]);

        //逻辑
        $query = request('query');
        $posts = \App\Post::search($query)->paginate(2);

        //渲染
        return view('post/search', compact('posts', 'query'));
    }
}
