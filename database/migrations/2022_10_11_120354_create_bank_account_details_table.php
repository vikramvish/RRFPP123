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
        Schema::create('bank_account_details', function (Blueprint $table) {
            $table->id();
            $table->string('Entity_Name');          
            $table->string('PAN_TAN_Number');
            $table->string('GST_Number');
            $table->string('Beneficiary_Name');
            $table->string('Beneficiary_Bank_Name');
            $table->string('Branch_Address');
            $table->string('Ac_Number');          
            $table->string('IFS_Code');
            $table->string('Name_of_Person_with_Designation');
            $table->string('Email_Id');
            $table->string('Mobile');
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
        Schema::dropIfExists('bank_account_details');
    }
};
