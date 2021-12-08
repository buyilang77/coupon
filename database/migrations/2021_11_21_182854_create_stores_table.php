<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id');
            $table->string('name')->comment('店铺名称');
            $table->string('photo')->nullable()->comment('图片');
            $table->string('contact', 20)->nullable()->comment('联系人');
            $table->string('phone', 11)->comment('手机号');
            $table->json('region')->nullable()->comment('地区');
            $table->string('address', 100)->nullable()->comment('详细地址');
            $table->json('business_hours');
            $table->tinyInteger('status')->default(0)->comment('经营状态 0: 未启用, 1: 启用');
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
        Schema::dropIfExists('stores');
    }
}
