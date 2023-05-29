<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_departmentmaster extends Model
{
    use HasFactory;
    protected $primaryKey = 'DepartmentId';
    protected $fillable = [  
        'DepartmentId',
        'DepartmentName',
        'DepartmentNameHindi',       
        'IsActive',
        'IsDeleted',       
        'CreatedBy',
        'UpdatedBy',        
        'CreatedAt',             
        'UpdatedAt',         
    ];
}
