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
        Schema::create('tbl_rolerights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('RoleId');                  
            $table->unsignedBigInteger('RightId');
            $table->string('IsActive');
            $table->foreign('RoleId')->references('RoleId')->on('tbl_rolemasters')->onDelete('cascade');           
            $table->foreign('RightId')->references('RightId')->on('tbl_rightmasters')->onDelete('cascade');           
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
        Schema::dropIfExists('tbl_rolerights');
    }
};
