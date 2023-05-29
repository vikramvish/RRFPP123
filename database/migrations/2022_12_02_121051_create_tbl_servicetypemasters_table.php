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
        Schema::create('tbl_servicetypemasters', function (Blueprint $table) {
            $table->id('ServiceTypeId');               
            $table->string('ServiceTypeName')->unique();          
            $table->integer('IsActive')->default('1');
            $table->integer('IsDeleted')->default('0');
            $table->integer('CreatedBy');
            $table->integer('UpdatedBy');
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
        Schema::dropIfExists('tbl_servicetypemasters');
    }
};
