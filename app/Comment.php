<?php

namespace App;

use App\Model;

class Comment extends Model
{
    //评论所属文章关联
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    //评论所属用户关联
    public function user(){
        return $this->belongsTo('App\User');
    }
}
