<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pgresponselog extends Model
{
    protected $primarykey = 'id';
    use HasFactory;
    protected $fillable = [ 
        'id',
        'RequestId',
        'ResponseMethod',         
        'Referrer',
        'EncryptedResponse',       
        'DecryptedResponse',
        'PaidAmount',        
        'CreatedAt',             
        'UpdatedAt',              
    ];
}
