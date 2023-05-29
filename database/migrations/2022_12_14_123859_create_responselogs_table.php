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
        Schema::create('responselogs', function (Blueprint $table) {
            $table->increments('id');            
            $table->foreign('FK_id')->references('PK_id ')->on('requestlogs')->onDelete('cascade'); 
            $table->string('RPPTXNID');
            $table->string('PRN');
            $table->string('MERCHANTCODE');
            $table->integer('REQTIMESTAMP');
            $table->string('CHECKSUM');
            $table->string('PAYMENTAMOUNT');
            $table->string('Encrypted_Response');
            $table->string('DecryptString');
            $table->integer('RPPTIMESTAMP');
            $table->string('Txn_Id');
            $table->string('PAYMENTMODE');
            $table->string('STATUS');
            $table->string('PAYMENTMODEBID');
            $table->string('PAYMENTMODETIMESTAMP');
            $table->string('RESPONSEMESSAGE');
            $table->string('RESPONSECODE');
            $table->string('UDF1');
            $table->string('UDF2');
            $table->string('UDF3');
            $table->string('CURRENCY');
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
        Schema::dropIfExists('responselogs');
    }
};
