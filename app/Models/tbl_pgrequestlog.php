<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pgrequestlog extends Model
{
    use HasFactory;
    // public function tbl_transactiondetail()
    // {
    //     return $this->belongsTo(tbl_transactiondetail::class);
    // }
    protected $primarykey = 'RequestId';
    protected $fillable = [  
        'RequestId',
        'PRN',         
        'ServiceTypeId',
        'TrackingID',       
        'EncryptedRequest',
        'DecryptedRequest',        
        'DepartmentId',             
        'SchemeId',   
        'PGId',  
        'TransactionAmount',  
        'CreatedAt',        
    ];
}
