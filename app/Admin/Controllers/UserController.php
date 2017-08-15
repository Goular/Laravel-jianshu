<?php
namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;

class UserController extends Controller
{
    //管理员列表页面
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view("/admin/user/index", compact('users'));
    }

    //管理员创建页面
    public function create()
    {
        return view("/admin/user/add");
    }

    //创建操作
    public function store()
    {
        //校验
        $this->validate(request(), [
            'name' => 'required|min:3|unique:admin_users',
            'password' => 'required'
        ]);

        //逻辑
        $name = request('name');
        $password = bcrypt(request('password'));
        $user = \App\AdminUser::create(compact('name', 'password'));

        //渲染
        return redirect('/admin/users');
    }

    //用户角色页面
    public function role(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;
        return view('/admin/user/role', compact('roles', 'myRoles', 'user'));
    }

    //储存用户角色
    public function storeRole(AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);
        //根据数组ID获取权限
        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;

        //执行需要增加的
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $user->assignRole($role);
        }

        //执行需要删除的
        $detachRoles = $myRoles->diff($roles);
        foreach ($detachRoles as $role) {
            $user->deleteRole($role);
        }

        return back();
    }
}