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
        Schema::create('tbl_departmentusers', function (Blueprint $table) {
            $table->bigIncrements('map_id');
            $table->unsignedBigInteger('DepartmentId');
            $table->unsignedBigInteger('user_id');
            $table->string('IsActive');
            $table->foreign('DepartmentId')->references('DepartmentId')->on('tbl_departmentmasters')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('tbl_usermasters')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_departmentusers');
    }
};
