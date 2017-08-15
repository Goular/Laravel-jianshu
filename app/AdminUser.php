<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName = "";

    //不是继承原来的\App\Model的都必须写这个，不然不能添加记录到数据库上
    protected $guarded = [];

    //用户有哪些角色
    public function roles()
    {
        return $this->belongsToMany(\App\AdminRole::class, 'admin_role_user', 'user_id', 'role_id')->withPivot(['user_id', 'role_id']);
    }

    //判断用户是否有某个角色，某些角色
    public function isInRoles($roles)
    {
        //intersect() 移除任何指定 数组 或集合内所没有的数值
        //!!直接输出的是变量的布尔值
        return !!$roles->intersect($this->roles)->count();
    }

    //用户是否有某个权限
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }

    //给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    //删除用户的某个角色
    public function deleteRole($role)
    {
        //detach为多对多关联表中删除关联表信息的行数据的方法
        return $this->roles()->detach($role);
    }
}