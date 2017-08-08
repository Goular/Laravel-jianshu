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
}
