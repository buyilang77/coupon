<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20)->comment('用户名');
            $table->string('surname', 10)->nullable()->comment('姓名');
            $table->string('merchant_name', 20)->nullable()->comment('商户名称');
            $table->string('phone', 11)->comment('手机号');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->json('region')->nullable()->comment('地区');
            $table->string('address', 100)->nullable()->comment('详细地址');
            $table->tinyInteger('status')->default(0)->comment('账号状态 0: 待审核, 1: 审核通过');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
