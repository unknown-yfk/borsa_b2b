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
        Schema::create('undelivered1_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->length(20)->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          
            $table->char('undelivered_quantity',255);
           
            $table->bigInteger('undelivered1_id')->length(20)->unsigned();
            $table->foreign('undelivered1_id')->references('id')->on('undelivered_orders')->onDelete('cascade');
          
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
        Schema::dropIfExists('undelivered1_products');
    }
};
