<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_schememetadata extends Model
{
    use HasFactory;
    protected $fillable = [
        'SchemeId',        
        'ShortDescription',
        'LongDescription',       
        ];
}

