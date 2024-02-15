<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_usermaster extends Model
{
    protected $primaryKey = 'user_id';
    use HasFactory;
    protected $fillable = [  
        'user_id',
        'SSOID',         
        'displayName',
        'designation',  
        'RoleId',
        'DepartmentId', 
        'IsActive',   
        'CreatedAt',      
    ];
    public function departments()
    {
        return $this->belongsToMany(tbl_departmentmaster::class, 'tbl_departmentusers', 'user_id', 'DepartmentId');
    }
    // public function departmentUsers()
    // {
    //     return $this->hasMany(tbl_departmentuser::class, 'user_id', 'user_id');
    // }
}
