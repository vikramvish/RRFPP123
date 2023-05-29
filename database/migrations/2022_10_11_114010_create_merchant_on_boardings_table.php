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
        Schema::create('merchant_on_boardings', function (Blueprint $table) {
            $table->id();
            $table->string('Department_Organization');
            $table->string('Type');
            $table->string('GST_Number');
            $table->string('Address');
            $table->string('City');
            $table->string('State');
            $table->string('Pin');
            $table->string('Official_eMail_Id_Organization');
            $table->string('Name_Nodal_Officer');
            $table->string('Designation_Nodal_Officer');
            $table->string('Mobile_No_Nodal_Officer');
            $table->string('Tel_No');
            $table->string('Official_eMail_Id_Nodal_Officer');
            $table->string('SSO_ID_Nodal_Officer');
            $table->string('Encryption');
            $table->string('Checksum');
            $table->string('alerts');
            $table->string('SMS');
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
        Schema::dropIfExists('merchant_on_boardings');
    }
};
