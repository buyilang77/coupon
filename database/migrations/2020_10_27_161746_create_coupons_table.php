<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id')->index();
            $table->json('products');
            $table->string('title')->index();
            $table->date('start_time');
            $table->date('end_time');
            $table->string('prefix')->comment('前缀');
            $table->string('start_number')->comment('起始编号');
            $table->mediumInteger('quantity')->comment('卡卷数量');
            $table->bigInteger('length')->comment('卡卷长度');
            $table->tinyInteger('status')->comment('默认状态 0:未启用, 1:启用, 3:已结束');
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
        Schema::dropIfExists('coupons');
    }
}
