<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_usermaster extends Model
{
    use HasFactory;
    protected $fillable = [  
        'id',
        'SSOID',         
        'displayName',
        'designation',  
        'RoleId', 
        'IsActive',   
        'CreatedAt',      
    ];
}
