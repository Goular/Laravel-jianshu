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

    /**
     * 我的粉丝
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fans()
    {
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }


    /**
     * 我粉的人
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
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
        return \App\Fan::where('star_id', $user_id)->where('fan_id', \Auth::id())->delete();
    }

    //设置某人关注自己
    public function doStar($user_id)
    {
        $fan = new \App\Fan();
        $fan->fan_id = $user_id;
        return $this->fans()->save($fan);
    }

    //取消某人关注自己
    public function doUnStar($user_id)
    {
        return \App\Fan::where('star_id', \Auth::id())->where('fan_id', $user_id)->delete();
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

    //用户收到的通知
    public function notices()
    {
        return $this->belongsToMany(\App\Notice::class, 'user_notice', 'user_id', 'notice_id')->withPivot(['user_id', 'notice_id']);
    }

    //给用户增加通知
    public function addNotice(Notice $notice)
    {
        return $this->notices()->save($notice);
    }

    //给用户删除通知
    public function detachNotice(Notice $notice)
    {
        return $this->notices()->detach($notice);
    }
}
