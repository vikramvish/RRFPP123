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
        Schema::create('tbl_schememasters', function (Blueprint $table) {     
            $table->id('SchemeId');             
            $table->string('SchemeName')->unique();
            $table->string('SchemeNameHindi')->unique();
            $table->unsignedBigInteger('DepartmentId');           
            $table->integer('IsActive')->default('1');
            $table->integer('IsDeleted')->default('0'); 
            $table->integer('CreatedBy');
            $table->integer('UpdatedBy');
            $table->foreign('DepartmentId')->references('DepartmentId')->on('tbl_departmentmasters');
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
        Schema::dropIfExists('tbl_schememasters');
    }
};
