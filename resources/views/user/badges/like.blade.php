@if($target_user->id != \Auth::id())
    @if($m_type == 1)
        <div>
            @if(\Auth::user()->hasStar($target_user->id))
                <button class="btn btn-default like-button" like-value="1" like-type="{{$m_type}}" like-user="{{$target_user->id}}"
                        _token="{{csrf_token()}}" type="button">取消关注
                </button>
            @else
                <button class="btn btn-default like-button" like-value="0" like-type="{{$m_type}}" like-user="{{$target_user->id}}"
                        _token="{{csrf_token()}}" type="button">关注
                </button>
            @endif
        </div>
    @elseif($m_type == 2)
        <div>
            @if($target_user->hasStar(\Auth::user()->id))
                <button class="btn btn-default like-button" like-value="1" like-type="{{$m_type}}" like-user="{{$target_user->id}}"
                        _token="{{csrf_token()}}" type="button">取消关注
                </button>
            @else
                <button class="btn btn-default like-button" like-value="0" like-type="{{$m_type}}" like-user="{{$target_user->id}}"
                        _token="{{csrf_token()}}" type="button">关注
                </button>
            @endif
        </div>
    @else
    @endif
@endif