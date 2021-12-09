<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeCardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_card_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recharge_card_id')->index();
            $table->bigInteger('shop_user_id')->nullable()->comment('用户ID');
            $table->decimal('balance')->default(0.00);
            $table->string('code')->index();
            $table->string('password');
            $table->tinyInteger('open_status')->default(0)->comment('状态 0:未开启, 1:已开启')->index();
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
        Schema::dropIfExists('recharge_card_items');
    }
}
