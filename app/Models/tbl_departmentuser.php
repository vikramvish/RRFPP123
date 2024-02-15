<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_departmentuser extends Model
{
    use HasFactory;
    protected $primaryKey = 'map_id';
    protected $fillable = [  
        'map_id',
        'DepartmentId',           
        'IsActive',        
        'CreatedAt',       
        'UpdatedAt',
    ];
}
