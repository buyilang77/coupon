<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeCardOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_card_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num');
            $table->bigInteger('card_id')->comment('用户ID');
            $table->bigInteger('coupon_id')->comment('所属活动');
            $table->bigInteger('store_id')->comment('门店');
            $table->bigInteger('merchant_id')->comment('商户ID');
            $table->decimal('total_amount')->comment('总金额');
            $table->string('contacts')->comment('收货人');
            $table->string('phone')->comment('电话');
            $table->json('region')->comment('地区');
            $table->string('address')->comment('地址');
            $table->tinyInteger('status')->default(0)->comment('当前状态 0: 未核销 , 1: 已核销');
            $table->timestamp('write_off_at')->nullable()->comment('核销日期');
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
        Schema::dropIfExists('recharge_card_orders');
    }
}
