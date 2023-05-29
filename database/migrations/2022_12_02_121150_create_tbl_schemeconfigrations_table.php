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
        Schema::create('tbl_schemeconfigrations', function (Blueprint $table) {  
            $table->id('SchemeId');              
            $table->string('MerchantCode')->unique();          
            $table->string('SchemeEncryptionKey');
            $table->string('SchemeChecksumKey');
            $table->string('BankAccountIFSC');
            $table->string('BankAccountNumber'); 
            $table->string('BankAccountAddress');
            $table->string('BankAccountFilePath');  
            $table->foreign('SchemeId')->references('SchemeId')->on('tbl_SchemeMasters');
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
        Schema::dropIfExists('tbl_schemeconfigrations');
    }
};
