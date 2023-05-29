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
        Schema::create('tbl_pgresponselogs', function (Blueprint $table) {
            $table->unsignedBigInteger('RequestId');             
            $table->foreign('RequestId')->references('RequestId')->on('tbl_PGRequestLogs')->onDelete('cascade');   
            $table->string('ResponseMethod')->default('POST');
            $table->string('Referrer'); 
            $table->string('EncryptedResponse');
            $table->string('DecryptedResponse'); 
            $table->string('PaidAmount')->default('0');           
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
        Schema::dropIfExists('tbl_pgresponselogs');
    }
};
