<?php

namespace App;


/**
 * 模型类Post默认的表的名称为:posts
 */
class Post extends Model
{
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //关联评论模型(一对多)
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }
}
