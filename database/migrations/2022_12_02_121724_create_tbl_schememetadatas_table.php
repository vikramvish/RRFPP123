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
        Schema::create('tbl_schememetadatas', function (Blueprint $table) {
            $table->id('SchemeId');             
            $table->foreign('SchemeId')->references('SchemeId')->on('tbl_SchemeMasters')->onDelete('cascade'); 
            $table->string('ShortDescription');
            $table->string('LongDescription');            
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
        Schema::dropIfExists('tbl_schememetadatas');
    }
};
