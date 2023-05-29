<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_rolemaster extends Model
{
    use HasFactory;
    protected $fillable = [  
        'RoleId',
        'RoleName',        
        'IsActive',
        'IsDeleted',             
        'CreatedAt',             
        'UpdatedAt',  
    ];
}
