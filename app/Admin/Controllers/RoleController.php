<?php
namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view("/admin/role/index", compact('roles'));
    }

    //创建角色
    public function create()
    {
        return view("/admin/role/add");
    }

    //创建角色行为
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);

        AdminRole::create(request(['name', 'description']));

        return redirect('/admin/roles');
    }

    //角色权限关系页面
    public function permission(AdminRole $role)
    {
        //获取所有权限
        $permissions = AdminPermission::all();
        //获取当前角色权限
        $myPermissions = $role->permissions;
        return view("/admin/role/permission", compact('permissions', 'myPermissions', 'role'));
    }

    //存储角色权限行为
    public function storePermission(\App\AdminRole $role)
    {
        $this->validate(request(), [
            'permissions' => 'required|array'
        ]);
        //根据数组ID获取权限
        $permissions = \App\AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;

        //执行需要增加的
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }

        //执行需要删除的
        $detachPermissions = $myPermissions->diff($permissions);
        foreach ($detachPermissions as $permission) {
            $role->deletePermission($permission);
        }

        return back();
    }
}