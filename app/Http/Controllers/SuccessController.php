<?php

namespace App\Http\Controllers;

use App\Models\form2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use App\Models\responselog;
use App\Models\tbl_pgresponselog;
use App\Models\tbl_transactiondetail;
use App\Models\requestlog;
use App\Models\tbl_transactionpaymentdetail;
use Illuminate\Support\Facades\Log;

class SuccessController extends Controller {
    public function successData( Request $request, $prn ) {
        // Log::debug( 'PRN: '.$prn );
        $MERCHANTCODE = 'testMerchant2';
        $key = 'WFsdaY28Pf';

        $MERCHANTCODE = $request->MERCHANTCODE;

        $ENCDATA = $request->ENCDATA;

        $Decryption = new Aes256encryption();
        $Decryption->setKey( '9759E1886FB5766DA58FF17FF8DD4' );
        $DecryptedStr = $Decryption->Decrypt( $ENCDATA );
        $data = json_decode( $DecryptedStr, true );
        //  dd($data);
        $pgId = 1;

        // Check if a record with the same PRN value already exists in the tbl_transactionpaymentdetail table
        $existingPaymentDetail = tbl_transactionpaymentdetail::where( 'PRN', $data[ 'PRN' ] )->first();

        if ( $existingPaymentDetail ) {
            // A record with the same PRN value already exists, update the existing record instead of inserting a new one
            $existingPaymentDetail->PaidAmount = $data[ 'PAYMENTAMOUNT' ];
            $existingPaymentDetail->PGID = $pgId;
            $existingPaymentDetail->RPPTxnId = $data[ 'RPPTXNID' ];
            $existingPaymentDetail->PGModeBID = $data[ 'PAYMENTMODEBID' ];

            $existingPaymentDetail->REQTIMESTAMP = $data[ 'REQTIMESTAMP' ];
            $existingPaymentDetail->AMOUNT = $data[ 'AMOUNT' ];
            $existingPaymentDetail->RPPTIMESTAMP = $data[ 'RPPTIMESTAMP' ];
            $existingPaymentDetail->STATUS = $data[ 'STATUS' ];
            $existingPaymentDetail->PAYMENTAMOUNT = $data[ 'PAYMENTAMOUNT' ];
            $existingPaymentDetail->CHECKSUM = $data[ 'CHECKSUM' ];

            $existingPaymentDetail->PayModeBankBID = 00000;
            //   $transactionpaymentdetails->PayModeCardCode = $data[ 'PayModeCardCode' ];
            $existingPaymentDetail->PayModeCardCode = 00000;
            //   $transactionpaymentdetails->PayModeCardType = $data[ 'PayModeCardType' ];
            $existingPaymentDetail->PayModeCardType = 00000;
            $existingPaymentDetail->PayModeBankName = $data[ 'PAYMENTMODE' ];
            $existingPaymentDetail->PaymentTimeStamp = $data[ 'PAYMENTMODETIMESTAMP' ];
            $existingPaymentDetail->RESPONSEMESSAGE = $data[ 'RESPONSEMESSAGE' ];
            $existingPaymentDetail->save();
        } else {
            // Insert a new record into the tbl_transactionpaymentdetail table
            $transactionpaymentdetails = new tbl_transactionpaymentdetail();
            $transactionpaymentdetails->PRN = $data[ 'PRN' ];
            $transactionpaymentdetails->PaidAmount = $data[ 'PAYMENTAMOUNT' ];
            $transactionpaymentdetails->PGID = $pgId;
            $transactionpaymentdetails->RPPTxnId = $data[ 'RPPTXNID' ];

            $transactionpaymentdetails->REQTIMESTAMP = $data[ 'REQTIMESTAMP' ];
            $transactionpaymentdetails->AMOUNT = $data[ 'AMOUNT' ];
            $transactionpaymentdetails->RPPTIMESTAMP = $data[ 'RPPTIMESTAMP' ];
            $transactionpaymentdetails->STATUS = $data[ 'STATUS' ];
            $transactionpaymentdetails->PAYMENTAMOUNT = $data[ 'PAYMENTAMOUNT' ];
            $transactionpaymentdetails->CHECKSUM = $data[ 'CHECKSUM' ];

            $transactionpaymentdetails->PayModeBankBID = 00000;
            //   $transactionpaymentdetails->PayModeCardCode = $data[ 'PayModeCardCode' ];
            $transactionpaymentdetails->PayModeCardCode = 00000;
            //   $transactionpaymentdetails->PayModeCardType = $data[ 'PayModeCardType' ];
            $transactionpaymentdetails->PayModeCardType = 00000;
            $transactionpaymentdetails->PGModeBID = $data[ 'PAYMENTMODEBID' ];
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
        $referrer = url()->previous() ?? 'Unknown';
        $responselog = tbl_pgresponselog::firstOrCreate( [
            'RequestId' => $requestId,
        ], [
            'ResponseMethod' => 'POST',
            'Referrer' => $referrer,
            'EncryptedResponse' => $ENCDATA,
            'DecryptedResponse' => $DecryptedStr,
            'PaidAmount' => $data[ 'PAYMENTAMOUNT' ],
        ] );

        // $collection = DB::table( 'tbl_transactiondetails' )
        // ->join( 'tbl_pgrequestlogs', 'tbl_pgrequestlogs.PRN', '=', 'tbl_transactiondetails.PRN' )
        // ->join( 'tbl_pgresponselogs', 'tbl_pgresponselogs.RequestId', '=', 'tbl_pgrequestlogs.RequestId' )
        // ->join( 'tbl_transactionpaymentdetails', 'tbl_pgrequestlogs.PRN', '=', 'tbl_transactionpaymentdetails.PRN' )
        // ->select( 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile', 'tbl_transactionpaymentdetails.*', 'tbl_transactiondetails.Currency', 'tbl_pgresponselogs.*' )
        // ->where( 'tbl_pgrequestlogs.PRN', $data[ 'PRN' ] )
        // ->first();
        $collection = DB::table('tbl_transactiondetails')
    ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
    ->select(
        'tbl_transactiondetails.RemitterName',
        'tbl_transactiondetails.RemitterMobile',       
        'tbl_transactionpaymentdetails.AMOUNT',
        'tbl_transactionpaymentdetails.PRN',
        'tbl_transactiondetails.RemitterEmailId',
        'tbl_transactionpaymentdetails.RPPTxnId',
        'tbl_transactionpaymentdetails.PayModeBankName',
        // 'tbl_transactionpaymentdetails.PaymentTimeStamp',
        'tbl_transactionpaymentdetails.PGModeBID',
        'tbl_transactionpaymentdetails.RESPONSEMESSAGE'
    )
    ->where('tbl_transactionpaymentdetails.PRN', $data[ 'PRN' ])
    ->first();

        return view( 'website/success', compact( 'collection' ) );
    }
    // {
    //     $responselog = new responselog();
    //     $MERCHANTCODE = 'testMerchant2';
    //     $key = 'WFsdaY28Pf';
    //     // $date = Carbon::now();
    //     // $todaydate = date( 'Ymdhmss' );

    //     // $Mobile_No = $request->RemitterMobile;
    //     // $responselog->RemitterMobile = $Mobile_No;

    //     // $Donnar_Name = $request->RemitterName;
    //     // $responselog->RemitterName = $Donnar_Name;

    //     $MERCHANTCODE = $request->MERCHANTCODE;
    //     $responselog->MERCHANTCODE = $MERCHANTCODE;

    //     $ENCDATA = $request->ENCDATA;
    //     $responselog->ENCDATA = $ENCDATA;

    //     $Decryption = new Aes256encryption();
    //     $Decryption->setKey( '9759E1886FB5766DA58FF17FF8DD4' );
    //     $DecryptedStr = $Decryption->Decrypt( $ENCDATA );
    //     $responselog->DecryptString = $DecryptedStr;
    //     $data = json_decode( $DecryptedStr, true );

    //     // echo '<pre>';
    //     // $data = ( array ) $data;

    //     // $values = [ 'MERCHANTCODE' => $data[ 'MERCHANTCODE' ], 'REQTIMESTAMP' => $data[ 'REQTIMESTAMP' ],
    //     // 'PRN' => $data[ 'PRN' ], 'RPPTXNID' => $data[ 'RPPTXNID' ], 'AMOUNT' => $data[ 'AMOUNT' ],
    //     // 'RPPTIMESTAMP' => $data[ 'RPPTIMESTAMP' ], 'STATUS' => $data[ 'STATUS' ], 'RESPONSECODE' => $data[ 'RESPONSECODE' ],
    //     // 'RESPONSEMESSAGE' => $data[ 'RESPONSEMESSAGE' ], 'PAYMENTMODE' => $data[ 'PAYMENTMODE' ],
    //     // 'PAYMENTMODEBID' => $data[ 'PAYMENTMODEBID' ], 'PAYMENTMODETIMESTAMP' => $data[ 'PAYMENTMODETIMESTAMP' ],
    //     // 'PAYMENTAMOUNT' => $data[ 'PAYMENTAMOUNT' ], 'CURRENCY' => $data[ 'CURRENCY' ], 'UDF1' => $data[ 'UDF1' ],
    //     // 'UDF2' => $data[ 'UDF2' ], 'UDF3' => $data[ 'UDF3' ], 'CHECKSUM' => $data[ 'CHECKSUM' ],
    //     // 'created_at' => now(), 'updated_at' => now() ];

    //     // $order = DB::table( 'orders' )->insert( $data );
    //     //DB::table( 'responselogs' )->Insert( $values );
    //     // print_r( $data );

    //     // $responselog->save();

    //     $saveData = responselog::create( $data );

    //     $collection = DB::table( 'responselogs' )
    //         ->join( 'tbl_transactiondetails', 'tbl_transactiondetails.PRN', '=', 'responselogs.PRN' )
    //         ->select( 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile' )
    //         // ->orderby( 'tbl_transactiondetails.PRN', 'desc' )
    //         //  ->orderby( 'PRN', 'desc' )
    //         ->orderBy( 'responselogs.created_at', 'desc' )
    //         ->first();
    //     // dd( $collection );
    //     return view( 'website/success', compact( 'saveData', 'collection' ) );
    // }
}

class Aes256Encryption {
    public $key;
    public $iv;
    public $method = 'AES-256-CBC';

    public function encrypt( $toBeEncryptString ) {
        return openssl_encrypt( $toBeEncryptString, $this->method, hex2Bin( $this->key ), 0, hex2Bin( $this->iv ) );
    }

    public function decrypt( $toBeDecryptString ) {
        return openssl_decrypt( $toBeDecryptString, $this->method, hex2Bin( $this->key ), 0, hex2Bin( $this->iv ) );
    }

    public function setKey( $key ) {
        $this->key = hash( 'sha256', $key );
        $this->iv = md5( $key );
    }
}
