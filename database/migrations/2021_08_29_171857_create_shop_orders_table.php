<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id')->comment('商户ID');
            $table->bigInteger('coupon_id')->comment('所属活动');
            $table->bigInteger('amount');
            $table->string('contact')->comment('联系人');
            $table->string('phone')->comment('电话');
            $table->json('region')->comment('地区');
            $table->string('address')->comment('地址');
            $table->tinyInteger('status')->default(0)->comment('当前状态 0: 未发货 , 1: 已发货');
            $table->tinyInteger('payment_status')->default(0)->comment('当前状态 0: 未发货 , 1: 已发货');
            $table->timestamp('payment_at')->nullable();
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
        Schema::dropIfExists('shop_orders');
    }
}
