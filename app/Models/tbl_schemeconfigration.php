<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_schemeconfigration extends Model
{
    use HasFactory;
    protected $primaryKey = 'SchemeId';
    protected $fillable = [  
        'SchemeId',
        'MerchantCode',         
        'SchemeEncryptionKey',
        'SchemeChecksumKey',       
        'BankAccountIFSC',
        'BankAccountNumber',        
        'BankAccountAddress',             
        'BankAccountFilePath',              
    ];
}
