<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_transactiondetail extends Model
{
    use HasFactory;
    // public function tbl_pgrequestlog()
    // {
    //     return $this->hasOne(tbl_pgrequestlog::class);
    // }

    protected $primarykey = 'PRN';
    protected $fillable = [
        // 'TransactionID',
        'PRN',
        'SchemeId',
        'TransactionAmount',
        'TrackingID',
        'REQTIMESTAMP',
        'IsRemittanceAnnonymous',
        'RemitterName',
        'RemitterAddress',
        'RemitterPAN',
        'RemitterMobile',
        'RemitterEmailId',
        'Purpose',
        'UDF1',
        'UDF2',
        'UDF3',
        'UDF4',
        'UDF5',
        'Currency',
        'CreatedAt',
    ];
}
