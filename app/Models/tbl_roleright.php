<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_roleright extends Model
{
    use HasFactory;
    protected $fillable = [  
        'id',
        'RoleId',        
        'RightId',
        'IsActive',             
        'CreatedAt',             
        'UpdatedAt',  
    ];
}
