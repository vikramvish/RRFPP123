<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_rightmaster extends Model
{
    use HasFactory;
    protected $fillable = [  
        'RightId',
        'RightName',        
        'RightCode',
        'IsActive', 
        'IsDeleted',            
        'CreatedAt',             
        'UpdatedAt',  
    ];
}
