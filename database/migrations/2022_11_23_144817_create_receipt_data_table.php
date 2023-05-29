<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_data', function (Blueprint $table) {
            $table->id();
            $table->uuid('PRN')->primary();
            $table->varchar('Request_Id');
            $table->varchar('MERCHANTCODE');
            $table->integer('Transaction_ID');
            $table->integer('REQTIMESTAMP');
            $table->varchar('PURPOSE');
            $table->varchar('Donnar_Name');
            $table->varchar('Donnar_pan');
            $table->text('Donnar_Address');
            $table->text('Donnar_Email_id');
            $table->string('Mobile_No');
            $table->varchar('Donnar_Amount');
            $table->varchar('SUCCESSURL');
            $table->varchar('FAILUREURL');
            $table->varchar('CANCELURL');
            $table->varchar('CALLBACKURL');
            $table->varchar('UDF1');
            $table->varchar('UDF2');
            $table->varchar('UDF3');
            $table->varchar('OFFICECODE');
            $table->varchar('REVENUEHEAD');
            $table->varchar('CHECKSUM');
            $table->varchar('CURRENCY');
            $table->varchar('create_By');
            $table->varchar('update_By');
            $table->integer('Isactive');
            $table->integer('Isdeleted');
            $table->varchar('Remark');
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
        Schema::dropIfExists('receipt_data');
    }
};
