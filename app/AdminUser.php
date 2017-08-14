<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName = "";

    //不是继承原来的\App\Model的都必须写这个，不然不能添加记录到数据库上
    protected $guarded = [];
}