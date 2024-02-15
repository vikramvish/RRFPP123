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
    
        // $text = 'देवस्थान विभाग मंदिर संस्कृति के संरक्षण और संवर्धन का एक विभाग है। देवस्थान मंदिर संस्कृति के संरक्षण और संवर्धन का एक विभाग है।विभाग समय की आवश्यकताओं के अनुरूप आधुनिकीकरण की ओर अग्रसर है. इसकी अधिकांश सूचनाएँ विभागीय पोर्टल पर सबके लिए सुलभ रूप किया. इनमें अनेक धर्मस्थल राजस्‍थान राज्‍य में ही नहीं, राज्‍य के बाहर भी बने. राज्‍य के बाहर भी बने.';
        // $length = mb_strlen($text);
        
        // dd($length);
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
