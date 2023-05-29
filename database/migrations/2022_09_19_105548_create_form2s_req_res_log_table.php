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
        Schema::create('form2s_req_res_log', function (Blueprint $table) {
            $table->PK_id ();       
            $table->uuid('PRN')->primary(); 
            $table->varchar('MERCHANTCODE'); 
            $table->integer('Transaction_ID');
            $table->varchar('PURPOSE');            
            $table->varchar('Donnar_Name'); 
            $table->varchar('Donnar_pan');
            $table->text('Donnar_Address');           
            $table->text('Donnar_Email_id');        
            $table->string('Mobile_No');      
            // {{ str_replace(' ', '', $table->Mobile_No); }}                        
            $table->varchar('Donnar_Amount');
            $table->varchar('SUCCESSURL');
            $table->varchar('FAILUREURL');
            $table->varchar('CANCELURL');
            $table->varchar('CALLBACKURL');
            $table->varchar('UDF1')->nullable();
            $table->varchar('UDF2');
            $table->varchar('UDF3');
            $table->varchar('OFFICECODE');
            $table->varchar('REVENUEHEAD');
            $table->varchar('Encrypted_Str');
            $table->varchar('Decrypt_Str');
            $table->varchar('CHECKSUM');
            $table->varchar('CURRENCY');
            $table->varchar('create_By');
            $table->varchar('update_By');
            $table->integer('Isactive');
            $table->integer('Isdeleted');
            $table->varchar('Message');
            $table->varchar('Transaction_Status');
            $table->varchar('Remark');    
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
        Schema::dropIfExists('form2s_req_res_log');
    }
};
