<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pgmaster extends Model
{
    use HasFactory;
    protected $fillable = [  
        'PGId',
        'PGName',         
        'IsActive',
        'IsDeleted',       
        'CreatedBy',
        'UpdatedBy',        
        'CreatedAt',             
        'UpdatedAt',         
    ];
}
