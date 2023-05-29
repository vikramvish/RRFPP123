<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\responselog;
use Illuminate\Support\Facades\DB;
use App\Models\tbl_pgresponselog;
use App\Models\tbl_transactiondetail;
use App\Models\requestlog;
use App\Models\tbl_transactionpaymentdetail;

class ResponceController extends Controller
{
    public function getData(Request $request)
    {
        $MERCHANTCODE = 'testMerchant2';
        $key = 'WFsdaY28Pf';

        $MERCHANTCODE = $request->MERCHANTCODE;

        $ENCDATA = $request->ENCDATA;

        $Decryption = new Aes256encryption();
        $Decryption->setKey( '9759E1886FB5766DA58FF17FF8DD4' );
        $DecryptedStr = $Decryption->Decrypt( $ENCDATA );
        $data = json_decode( $DecryptedStr, true );
        // dd($data);
        $pgId = 1;

        // Check if a record with the same PRN value already exists in the tbl_transactionpaymentdetail table
        $existingPaymentDetail = tbl_transactionpaymentdetail::where( 'PRN', $data[ 'PRN' ] )->first();

        if ( $existingPaymentDetail ) {
            // A record with the same PRN value already exists, update the existing record instead of inserting a new one
            $existingPaymentDetail->PaidAmount = $data[ 'PAYMENTAMOUNT' ];
            $existingPaymentDetail->PGID = $pgId;
            $existingPaymentDetail->RPPTxnId = $data[ 'RPPTXNID' ];
            $existingPaymentDetail->PGModeBID = $data[ 'PAYMENTMODEBID' ];
            $existingPaymentDetail->PayModeBankBID = 00000;
            //   $transactionpaymentdetails->PayModeCardCode = $data[ 'PayModeCardCode' ];
            $existingPaymentDetail->PayModeCardCode = 00000;
            //   $transactionpaymentdetails->PayModeCardType = $data[ 'PayModeCardType' ];
            $existingPaymentDetail->PayModeCardType = 00000;
            $existingPaymentDetail->PayModeBankName = $data[ 'PAYMENTMODE' ];

            $existingPaymentDetail->REQTIMESTAMP = $data[ 'REQTIMESTAMP' ];
            $existingPaymentDetail->AMOUNT = $data[ 'AMOUNT' ];
            $existingPaymentDetail->RPPTIMESTAMP = $data[ 'RPPTIMESTAMP' ];
            $existingPaymentDetail->STATUS = $data[ 'STATUS' ];
            $existingPaymentDetail->PAYMENTAMOUNT = $data[ 'PAYMENTAMOUNT' ];
            $existingPaymentDetail->CHECKSUM = $data[ 'CHECKSUM' ];

            $existingPaymentDetail->PaymentTimeStamp = $data[ 'PAYMENTMODETIMESTAMP' ];
            $existingPaymentDetail->RESPONSEMESSAGE = $data[ 'RESPONSEMESSAGE' ];
            $existingPaymentDetail->save();
        } else {
            // Insert a new record into the tbl_transactionpaymentdetail table
            $transactionpaymentdetails = new tbl_transactionpaymentdetail();
            $transactionpaymentdetails->PRN = $data[ 'PRN' ];
            $transactionpaymentdetails->PaidAmount = $data[ 'AMOUNT' ];
            $transactionpaymentdetails->PGID = $pgId;
            $transactionpaymentdetails->RPPTxnId = $data[ 'RPPTXNID' ];
            $transactionpaymentdetails->PayModeBankBID = 00000;
            //   $transactionpaymentdetails->PayModeCardCode = $data[ 'PayModeCardCode' ];
            $transactionpaymentdetails->PayModeCardCode = 00000;
            //   $transactionpaymentdetails->PayModeCardType = $data[ 'PayModeCardType' ];
            $transactionpaymentdetails->PayModeCardType = 00000;
            $transactionpaymentdetails->PGModeBID = $data[ 'PAYMENTMODEBID' ];

            $transactionpaymentdetails->REQTIMESTAMP = $data[ 'REQTIMESTAMP' ];
            $transactionpaymentdetails->AMOUNT = $data[ 'AMOUNT' ];
            $transactionpaymentdetails->RPPTIMESTAMP = $data[ 'RPPTIMESTAMP' ];
            $transactionpaymentdetails->STATUS = $data[ 'STATUS' ];
            $transactionpaymentdetails->PAYMENTAMOUNT = $data[ 'PAYMENTAMOUNT' ];
            $transactionpaymentdetails->CHECKSUM = $data[ 'CHECKSUM' ];

            $transactionpaymentdetails->PayModeBankName = $data[ 'PAYMENTMODE' ];
            $transactionpaymentdetails->PaymentTimeStamp = $data[ 'PAYMENTMODETIMESTAMP' ];
            $transactionpaymentdetails->RESPONSEMESSAGE = $data[ 'RESPONSEMESSAGE' ];
            $transactionpaymentdetails->save();
        }

        $transaction = DB::table( 'tbl_pgrequestlogs' )
        ->where( 'PRN', $data[ 'PRN' ] )
        ->select( 'RequestId' )
        ->first();
        $requestId = $transaction->RequestId;

        //for stoping duplicate entry
        $responselog = tbl_pgresponselog::firstOrCreate( [
            'RequestId' => $requestId,
        ], [
            'ResponseMethod' => 'POST',
            'Referrer' => url()->previous(),
            'EncryptedResponse' => $ENCDATA,
            'DecryptedResponse' => $DecryptedStr,
            'PaidAmount' => $data[ 'PAYMENTAMOUNT' ],
        ] );

        $collection = DB::table('tbl_transactiondetails')
    ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
    ->select(

        'tbl_transactiondetails.RemitterName',
        'tbl_transactiondetails.RemitterMobile',
        'tbl_transactionpaymentdetails.PRN',
        'tbl_transactionpaymentdetails.AMOUNT',
        'tbl_transactiondetails.RemitterEmailId',
        'tbl_transactionpaymentdetails.RPPTxnId',
        'tbl_transactionpaymentdetails.PayModeBankName',
        // 'tbl_transactionpaymentdetails.PaymentTimeStamp',
        'tbl_transactionpaymentdetails.PGModeBID',
        'tbl_transactionpaymentdetails.RESPONSEMESSAGE'
    )
    ->where('tbl_transactionpaymentdetails.PRN', $data[ 'PRN' ])
    ->first();
// dd($collection);
        return view( 'website/success', compact( 'collection' ) );
    }
  
}
class Aes256Encryption
{
    public $key;
    public $iv;
    public $method = 'AES-256-CBC';

    public function encrypt($toBeEncryptString)
    {
        return openssl_encrypt($toBeEncryptString, $this->method, hex2Bin($this->key), 0, hex2Bin($this->iv));
    }

    public function decrypt($toBeDecryptString)
    {
        return openssl_decrypt($toBeDecryptString, $this->method, hex2Bin($this->key), 0, hex2Bin($this->iv));
    }

    public function setKey($key)
    {
        $this->key = hash('sha256', $key);
        $this->iv = md5($key);
    }
}
