<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_schememaster extends Model
{
    use HasFactory;
    protected $table = 'tbl_schememasters';
    protected $primaryKey = 'SchemeId';
    protected $fillable = [  
        'SchemeId',
        'SchemeName',         
        'SchemeNameHindi',
        'DepartmentId',
        'IsActive',        
        'IsDeleted',             
        'CreatedBy',         
        'UpdatedBy',        
        'CreatedAt',             
        'UpdatedAt',  
    ];
    public function tbl_departmentmasters()
{
    return $this->belongsTo('App\Models\tbl_departmentmaster', 'DepartmentId');
}
}
