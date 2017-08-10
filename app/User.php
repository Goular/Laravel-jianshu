<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password'
    ];

    //当前用户的文章的列表
    public function posts()
    {
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }

    //关注我的Fans列表
    public function fans()
    {
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }

    //我关注的Stars列表
    public function stars()
    {
        return $this->hasMany(\App\Fan::class, 'fan_id', 'id');
    }

    //关注某人
    public function doFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnFan($user_id)
    {
        $fan = new \App\Fan();
        $fan->star_id = $user_id;
        return $this->stars()->delete($fan);
    }

    //判断当前用户是否被uid关注
    public function hasFan($user_id)
    {
        return $this->fans()->where('fan_id', $user_id)->count();
    }


    //判断当前用户是否关注了uid
    public function hasStar($user_id)
    {
        return $this->stars()->where('star_id', $user_id)->count();
    }
}
