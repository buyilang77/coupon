<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id')->index();
            $table->string('name')->comment('卡券名称')->index();
            $table->decimal('price')->default(0.00)->index();
            $table->decimal('denomination')->default(0.00)->index();
            $table->tinyInteger('type')->comment('卡券形式 1:电子卡, 2:实物卡')->index();
            $table->tinyInteger('is_online')->nullable()->comment('实物卡销售 0:线下 1:线上')->index();
            $table->json('carousel')->nullable()->comment('轮播图');
            $table->string('remark')->nullable()->comment('活动说明');
            $table->mediumText('activity_description')->nullable()->comment('活动介绍');
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
        Schema::dropIfExists('recharge_cards');
    }
}
