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
        Schema::create('tbl_usermasters', function (Blueprint $table) {
            $table->id();
            $table->string('UserName');
            $table->string('displayName');
            $table->string('designation');
            $table->unsignedBigInteger('RoleId');
            $table->foreign('RoleId')->references('RoleId')->on('tbl_rolemasters')->onDelete('cascade');
            $table->string('IsActive');
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
        Schema::dropIfExists('tbl_usermasters');
    }
};
