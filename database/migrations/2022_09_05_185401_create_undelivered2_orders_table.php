<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('undelivered2_orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('rsp_id')->length(20)->unsigned();
            $table->foreign('rsp_id')->references('user_id')->on('rsps')->onDelete('cascade');
        
            $table->bigInteger('rom_id')->length(20)->unsigned();
            $table->foreign('rom_id')->references('user_id')->on('roms')->onDelete('cascade');
        
            $table->bigInteger('order_id')->length(20)->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
          

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
        Schema::dropIfExists('undelivered2_orders');
    }
};
