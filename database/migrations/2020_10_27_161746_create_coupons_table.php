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
            $table->decimal('price')->default(0.00)->index();
            $table->decimal('original_price')->default(0.00)->index();
            $table->string('title')->comment('活动名称')->index();
            $table->string('services_phone', 15)->nullable()->comment('客服电话');
            $table->json('products');
            $table->string('activity_description')->nullable()->comment('活动说明');
            $table->string('prefix', '15')->nullable()->comment('前缀');
            $table->string('start_number')->nullable()->comment('起始编号');
            $table->mediumInteger('quantity')->nullable()->comment('卡券数量');
            $table->bigInteger('length')->nullable()->comment('卡券长度');
            $table->tinyInteger('type')->default(2)->comment('卡券类型 1:储值卡, 2:单次卡, 3:多次卡')->index();
            $table->tinyInteger('form')->default(2)->comment('卡券形式 1:电子卡, 2:实物卡')->index();
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
