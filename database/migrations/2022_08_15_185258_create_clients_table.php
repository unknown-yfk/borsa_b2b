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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->length(20)->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unique(); 
            $table->char('client_address',255) ; 
            $table->char('client_mobile',255) ; 
            $table->char('client_businessName',255) ; 
            $table->char('client_businessType',255) ; 
            $table->char('client_BusinessRegisteration',255) ; 
            $table->char('client_yearsInBusiness',255) ; 

            $table->float('client_latitude', 10, 8)->nullable();
            $table->float('client_longtude', 11, 8)->nullable();
            $table->char('client_verificationData',255)->nullable();
            $table->bigInteger('distro_id')->length(20)->unsigned()->nullable();
            $table->foreign('distro_id')->references('user_id')->on('key_distros')->onDelete('cascade');



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
        Schema::dropIfExists('clients');
    }
};
