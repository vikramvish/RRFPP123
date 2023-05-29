<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\receipt_data;
use App\Models\tbl_transactionpaymentdetail;
use App\Models\tbl_transactiondetail;
use PDF;
use Illuminate\Database\Eloquent\Builder;

class ReceipttController extends Controller {
    public function index( Request $request ) {
        $searchText = $request->input( 'PRN-Number' );

        if ( $searchText ) {
            $countries = tbl_transactionpaymentdetail::join( 'tbl_transactiondetails', 'tbl_transactiondetails.PRN', 'tbl_transactionpaymentdetails.PRN' )
            ->where( 'tbl_transactionpaymentdetails.PRN', $searchText )
            ->orWhere( 'tbl_transactiondetails.RemitterMobile', $searchText )
            ->paginate( 20 );

            return view( 'Receiptt', [ 'countries' => $countries ] );
        }

        return view( 'Receiptt' );
        // if ( isset( $_GET[ 'PRN-Number' ] ) ) {
        //     $search_text = $_GET[ 'PRN-Number' ];

        //     $countries = tbl_transactionpaymentdetail::join( 'tbl_transactiondetails', 'tbl_transactiondetails.PRN', 'tbl_transactionpaymentdetails.PRN' )
        //         ->where( 'tbl_transactionpaymentdetails.PRN', $search_text )
        //         ->orwhere( 'tbl_transactiondetails.RemitterMobile', $search_text )
        //         ->paginate( 20 );
        //     return view( 'Receiptt', [ 'countries' => $countries ] );
        // } else {
        //     return view( 'Receiptt' );
        // }
    }
}
