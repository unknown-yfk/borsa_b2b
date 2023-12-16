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
        Schema::create('rsps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->length(20)->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

          
            $table->char('address',255) ;
            $table->char('mobile',255) ;
            $table->string('id_filepath');
            $table->char('ID_type',255);
            $table->char('ID_number',255);
            $table->date('ID_issue_date');
            $table->date('ID_expiry_date');
            $table->string('company_id_filepath');
            $table->char('company_id_number',255);
            $table->date('company_id_issue_date');
            $table->date('company_id_expiry_date');

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
        Schema::dropIfExists('rsps');
    }
};
