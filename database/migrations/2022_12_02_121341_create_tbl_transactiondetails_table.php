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
        Schema::create('tbl_transactiondetails', function (Blueprint $table) {
            $table->id('PRN'); 
            $table->unsignedBigInteger('SchemeId'); 
            $table->unsignedBigInteger('DepartmentId');           
            $table->foreign('SchemeId')->references('SchemeId')->on('tbl_SchemeMasters')->onDelete('cascade');  
            $table->foreign('DepartmentId')->references('DepartmentId')->on('tbl_departmentmasters')->onDelete('cascade');             
            $table->integer('TransactionAmount')->default('0');
            // $table->integer('PRN');
            $table->bigInteger('REQTIMESTAMP');
            $table->integer('TrackingID');
            $table->string('IsRemittanceAnnonymous')->default('0');
            $table->string('RemitterName'); 
            $table->string('RemitterAddress'); 
            $table->string('RemitterPAN'); 
            $table->string('RemitterMobile'); 
            $table->string('RemitterEmailId'); 
            $table->string('Purpose')->default('Donation'); 
            $table->string('UDF1'); 
            $table->string('UDF2'); 
            $table->string('UDF3'); 
            $table->string('UDF4'); 
            $table->string('UDF5'); 
            $table->string('Currency')->default('INR'); 
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
        Schema::dropIfExists('tbl_transactiondetails');
    }
};
