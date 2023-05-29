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
        Schema::create('tbl_pgrequestlogs', function (Blueprint $table) {
            $table->id('RequestId');  
            $table->unsignedBigInteger('PRN'); 
            $table->unsignedBigInteger('ServiceTypeId');           
            $table->string('TrackingID');
            $table->string('EncryptedRequest');
            $table->string('DecryptedRequest');
            $table->unsignedBigInteger('DepartmentId'); 
            $table->unsignedBigInteger('SchemeId'); 
            $table->unsignedBigInteger('PGId'); 
            $table->integer('TransactionAmount');
            $table->foreign('PRN')->references('PRN')->on('tbl_transactiondetails');
            $table->foreign('ServiceTypeId')->references('ServiceTypeId')->on('tbl_servicetypemasters')->onDelete('cascade');               
            $table->foreign('DepartmentId')->references('DepartmentId')->on('tbl_departmentmasters');
            $table->foreign('SchemeId')->references('SchemeId')->on('tbl_schememasters');
            $table->foreign('PGId')->references('PGId')->on('tbl_pgmasters');       

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
        Schema::dropIfExists('tbl_pgrequestlogs');
    }
};
