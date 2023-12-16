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
        Schema::create('ordered_products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_id')->length(20)->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          
            $table->char('ordered_quantity',255);
            $table->double('subTotal',255)->nullable();

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
        Schema::dropIfExists('ordered_products');
    }
};
