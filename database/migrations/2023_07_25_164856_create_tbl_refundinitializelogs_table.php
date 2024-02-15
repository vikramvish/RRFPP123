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
        Schema::create('tbl_refundinitializelogs', function (Blueprint $table) {
            $table->id();
            $table->string('REFUNDID')->nullable();
            $table->string('SUBORDERID')->nullable();
            $table->string('REFUNDSTATUS')->nullable();
            $table->string('REFUNDTIMESTAMP')->nullable();
            $table->string('STATUS')->nullable();
            $table->string('REMARKS')->nullable();
            $table->string('RESPONSECODE')->nullable();
            $table->string('RESPONSEMESSAGE')->nullable();
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
        Schema::dropIfExists('tbl_refundinitializelogs');
    }
};
