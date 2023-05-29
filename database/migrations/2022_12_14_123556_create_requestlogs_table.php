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
        Schema::create('requestlogs', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('Request_Id'); 
            $table->uuid('PRN')->primary(); 
            $table->string('PlainRequestData'); 
            $table->string('EncryptedReqString');
            $table->integer('Transaction_ID');
            $table->string('Donnar_Name'); 
            $table->string('Donnar_pan');
            $table->string('Mobile_No'); 
            $table->integer('Donnar_Amount');
            $table->string('CHECKSUM');
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
        Schema::dropIfExists('requestlogs');
    }
};
