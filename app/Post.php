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

    //与用户的点赞进行关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    //文章关联的所有点赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class, 'post_id', 'id');
    }
}
