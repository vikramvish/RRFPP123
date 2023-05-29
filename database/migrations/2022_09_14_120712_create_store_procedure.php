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
        $procedure = "DROP PROCEDURE IF EXISTS `SP_TEST`;
        CREATE PROCEDURE `SP_TEST` (IN PK_idx int)
        BEGIN
        SELECT * FROM form2s WHERE PK_id = PK_idx;
        END;";

    \DB::unprepared($procedure);
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_procedure');
    }
};
