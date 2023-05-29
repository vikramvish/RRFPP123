<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_departmentmetadata extends Model
{
    use HasFactory;
    protected $primaryKey = 'DepartmentId';
    protected $fillable = [
        'DepartmentId',  
        'Slug',  
        'Heading',    
        'ShortDescription',
        'LongDescription',  
        'Images',     
        ];
}
