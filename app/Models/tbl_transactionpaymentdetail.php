<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_transactionpaymentdetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'PRN';
    protected $fillable = [  
        'PRN',
        'PaidAmount',         
        'PGID',
        'RPPTxnId',
        'PGModeBID',         
        'REQTIMESTAMP',
        'AMOUNT',
        'RPPTIMESTAMP',
        'STATUS',
        'PAYMENTAMOUNT',
        'CHECKSUM',
        'PayModeBankName',             
        'PayModeBankBID',         
        'PayModeCardCode', 
        'PayModeCardType',             
        'PaymentTimeStamp', 
        'RESPONSEMESSAGE',        
        'CreatedAt',         
    ];
    public function scheme()
{
    return $this->belongsTo(tbl_schememaster::class, 'SchemeId', 'SchemeId');
}
}
