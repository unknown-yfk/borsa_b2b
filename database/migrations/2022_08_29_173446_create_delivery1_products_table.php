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
        Schema::create('delivery1_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->length(20)->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          
            $table->char('delivered_quantity',255);
            $table->double('subTotal',255)->nullable();

            $table->bigInteger('delivery1_id')->length(20)->unsigned();
            $table->foreign('delivery1_id')->references('id')->on('delivery1s')->onDelete('cascade');
          

            
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
        Schema::dropIfExists('delivery1_products');
    }
};
