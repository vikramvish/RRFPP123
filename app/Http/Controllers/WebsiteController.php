<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tbl_departmentmetadata;
use App\Models\tbl_departmentmaster;

class WebsiteController extends Controller
{   
    public function index(Request $request)
    {
        $count = DB::table('tbl_departmentmasters')->where('IsActive', 1)->count();
        // $transaction = DB::table('tbl_transactiondetails')->count();
        $transaction = DB::table('tbl_transactiondetails')
            ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
            ->count();
        // below sub query is use for show only status 1 data 
        $users = tbl_departmentmetadata::whereIn('DepartmentId', function($query) {
            $query->select('DepartmentId')
                ->from('tbl_departmentmasters')
                ->where('IsActive', 1);
        })->get();        
        // $balance = DB::table('tbl_transactiondetails')->sum('TransactionAmount');      
        $balance = DB::table('tbl_transactiondetails')
        ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
        ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
        ->sum('tbl_transactiondetails.TransactionAmount');  
        return view('website/website', compact('users'))
            ->with(['count' => $count])
            ->with(['balance' => $balance])
            ->with(['transaction' => $transaction]);
    }    
}
