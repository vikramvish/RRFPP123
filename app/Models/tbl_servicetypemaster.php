<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_servicetypemaster extends Model
{
    use HasFactory;
    protected $fillable = [  
        'ServiceTypeId ',
        'ServiceTypeName ',         
        'IsActive',
        'IsDeleted',
        'CreatedBy',        
        'UpdatedBy',             
        'CreatedAt',         
        'UpdatedAt',          
    ];
}
