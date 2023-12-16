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
        Schema::create('key_distros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->length(20)->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unique();
            $table->char('address',255) ;
            $table->char('mobile',255) ;
            $table->string('id_file_path');
            $table->char('ID_type',255);
            $table->char('ID_number',255);
            $table->date('ID_issue_date');
            $table->date('ID_expiry_date');
            
            $table->char('businessName',255) ;
            $table->char('businessType',255) ;
            $table->char('businessAddress',255) ;
            $table->string('licenceFilePath') ;
            $table->char('licenceNumber',255) ;
            $table->date('issueDate');
            $table->date('expiryDate');
            $table->char('tinNumber',255);
            $table->char('businessEstablishmentYear',255);
            $table->float('latitude')->nullable();
            $table->float('longtude')->nullable();
            $table->char('verificationData',255)->nullable();


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
        Schema::dropIfExists('key_distros');
    }
};
