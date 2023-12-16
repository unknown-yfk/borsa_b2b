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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('client_id')->length(20)->unsigned();
            $table->foreign('client_id')->references('user_id')->on('clients')->onDelete('cascade');
            $table->bigInteger('KD_id')->length(20)->unsigned();
            $table->foreign('KD_id')->references('distro_id')->on('clients')->onDelete('cascade');
           
            $table->date('createdDate');
            $table->bigInteger('createdBy')->length(20)->unsigned();
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('cascade');
            
         $table->double('totalPrice')->nullable();
         $table->string('confirmStatus')->nullable();
          $table->string('paymentStatus')->nullable();
          $table->string('deliveryStatus')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
