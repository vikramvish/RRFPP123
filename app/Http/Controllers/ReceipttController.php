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
        $mobileNumber = $request->input('mobile_number');
        $prnNumber = $request->input('prn_number');
    
        if ($mobileNumber || $prnNumber) {
            $query = tbl_transactionpaymentdetail::join('tbl_transactiondetails', 'tbl_transactiondetails.PRN', 'tbl_transactionpaymentdetails.PRN');
    
            if ($mobileNumber) {
                $query->where('tbl_transactiondetails.RemitterMobile', $mobileNumber);
            }    
            if ($prnNumber) {
                $query->where('tbl_transactionpaymentdetails.PRN', $prnNumber);
            }    
            $countries = $query->paginate(20);
    
            return view('Receiptt', ['countries' => $countries]);
        }
    
        return view('Receiptt');     
      
    }
}
