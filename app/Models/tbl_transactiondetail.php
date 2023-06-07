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
    public function department()
    {
        return $this->belongsTo(tbl_departmentmaster::class, 'DepartmentId', 'DepartmentId');
    }
    
    public function scheme()
    {
        return $this->belongsTo(tbl_schememaster::class, 'SchemeId');
    }
    protected $primarykey = 'PRN';
    protected $fillable = [
        // 'TransactionID',
        'PRN',
        'SchemeId',
        'DepartmentId',
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
    // public function department()
    // {
    //     return $this->belongsTo(tbl_departmentmaster::class, 'DepartmentId');
    // }
    // public function scheme()
    // {
    //     return $this->belongsTo(tbl_schememaster::class, 'SchemeId');
    // }
    // public function tbl_schememasters()
    // {
    //     return $this->belongsTo('App\Models\tbl_schememaster', 'SchemeId');
    // }   
}
