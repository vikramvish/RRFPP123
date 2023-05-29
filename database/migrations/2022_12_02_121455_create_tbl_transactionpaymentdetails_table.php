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
        Schema::create('tbl_transactionpaymentdetails', function (Blueprint $table) {           
            $table->unsignedBigInteger('PRN')->primary();            
            $table->integer('PaidAmount')->default('0.00');
            $table->integer('PGID');
            $table->integer('RPPTxnId');
            $table->string('PGModeBID');

            $table->string('REQTIMESTAMP');
            $table->integer('AMOUNT');
            $table->string('RPPTIMESTAMP');
            $table->string('STATUS');
            $table->integer('PAYMENTAMOUNT');
            $table->string('CHECKSUM');

            $table->string('PayModeBankName'); 
            $table->string('PayModeBankBID'); 
            $table->string('PayModeCardCode'); 
            $table->string('PayModeCardType');
            $table->string('PaymentTimeStamp');
            $table->string('RESPONSEMESSAGE');
            $table->foreign('PRN')->references('PRN')->on('tbl_transactiondetails')->onDelete('cascade');               

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
        Schema::dropIfExists('tbl_transactionpaymentdetails');
    }
};
