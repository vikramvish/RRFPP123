<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_refundinitializelog extends Model
{
    use HasFactory;
    protected $fillable = [  
        'id',
        'REFUNDID',         
        'SUBORDERID',
        'REFUNDSTATUS',       
        'REFUNDTIMESTAMP',
        'STATUS',        
        'REMARKS',             
        'RESPONSECODE', 
        'RESPONSEMESSAGE',    
        'created_at',
        'updated_at'    
    ];
}
