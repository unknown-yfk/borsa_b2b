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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->bigInteger('catagory_id')->length(20)->unsigned();
            $table->foreign('catagory_id')->references('id')->on('product_catagories')->onDelete('cascade');
            $table->bigInteger('catagory_id')->length(20)->unsigned();
            $table->foreign('productType_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('image');


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
        Schema::dropIfExists('products');
    }
};
