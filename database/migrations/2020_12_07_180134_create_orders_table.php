<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->comment('提货码');
            $table->string('coupon_id')->comment('所属活动');
            $table->bigInteger('order_product_id')->comment('所提商品')->index();
            $table->string('consignee')->comment('收货人');
            $table->string('phone')->comment('收货电话');
            $table->json('region')->comment('地区');
            $table->string('status')->default(0)->comment('当前状态 0: 未发货 , 1: 已发货');
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
        Schema::dropIfExists('orders');
    }
}
