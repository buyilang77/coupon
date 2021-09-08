<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_users', function (Blueprint $table) {
            $table->id();
            $table->string('mp_openid')->nullable();
            $table->string('unionid')->nullable();
            $table->string('username', 20)->comment('用户名');
            $table->string('phone', 11)->nullable()->comment('手机号');
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->json('region')->nullable()->comment('地区');
            $table->string('address', 100)->nullable()->comment('详细地址');
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
        Schema::dropIfExists('shop_users');
    }
}
