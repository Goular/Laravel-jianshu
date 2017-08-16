<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{

    public function up()
    {
        //通知表
        Schema::create('notices',function (Blueprint $table){
            $table->increments('id');
            $table->string('title',50)->default("");
            $table->string('content',1000)->default("");
            $table->timestamps();
        });
        //用户通知关联表
        Schema::create('user_notice',function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('notice_id')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notices');
        Schema::dropIfExists('user_notice');
    }
}
