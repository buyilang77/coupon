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
            $table->string('username')->comment('用户名');
            $table->string('surname')->nullable()->comment('姓名');
            $table->string('merchant_name')->nullable()->comment('商户名称');
            $table->string('phone');
            $table->string('password');
            $table->json('region')->nullable()->comment('地区');
            $table->string('address')->nullable()->comment('详细地址');
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
