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
        Schema::create('tbl_departmentmetadatas', function (Blueprint $table) {
            $table->id('DepartmentId');
            $table->id('Slug');
            $table
                ->foreign('DepartmentId')
                ->references('DepartmentId')
                ->on('tbl_departmentmasters')
                ->onDelete('cascade');
            $table->string('Heading');
            $table->string('ShortDescription');
            $table->string('LongDescription');
            $table->string('Images');
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
        Schema::dropIfExists('tbl_departmentmetadatas');
    }
};
