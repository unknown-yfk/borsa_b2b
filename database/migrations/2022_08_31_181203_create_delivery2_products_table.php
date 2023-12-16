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
        Schema::create('delivery2_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->length(20)->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          
            $table->char('delivered_quantity',255);
            $table->double('subTotal',255)->nullable();

            $table->bigInteger('delivery2_id')->length(20)->unsigned();
            $table->foreign('delivery2_id')->references('id')->on('delivery2s')->onDelete('cascade');
          

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
        Schema::dropIfExists('delivery2_products');
    }
};
