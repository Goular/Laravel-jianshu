@extends('layout.main')

@section('content')
    @foreach($notices as $notice)
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <p class="blog-post-meta">{{$notice->title}}</p>
                <p>{{$notice->content}}</p>
            </div>
        </div>
    @endforeach
@endsection