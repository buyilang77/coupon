<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coupon_id')->index();
            $table->string('code')->index();
            $table->string('password');
            $table->tinyInteger('open_status')->default(0)->comment('状态 0:未开启, 1:已开启')->index();
            $table->tinyInteger('redemption_status')->default(0)->comment('状态 0:未兑换, 1:已兑换')->index();
            $table->tinyInteger('payment_status')->default(0)->comment('状态 0:未购买, 1:已购买')->index();
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
        Schema::dropIfExists('coupon_items');
    }
}
