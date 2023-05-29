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
        $count = DB::table('tbl_departmentmasters')->count();
        $transaction = DB::table('tbl_transactiondetails')->count();
        $users = tbl_departmentmetadata::all();
        $balance = DB::table('tbl_transactiondetails')->sum('TransactionAmount');
        return view('website/website', compact('users'))
            ->with(['count' => $count])
            ->with(['balance' => $balance])
            ->with(['transaction' => $transaction]);
    }
    // public function search(Request $request)
    // {
    //     $query = $request->get('query');
    //     $count = DB::table('tbl_departmentmasters')->count();
    //     $transaction = DB::table('tbl_transactiondetails')->count();
    //     $users = tbl_departmentmetadata::all();
    //     $balance = DB::table('tbl_transactiondetails')->sum('TransactionAmount');

    //     return view('website/website', compact('users'))
    //         ->with(['count' => $count])
    //         ->with(['balance' => $balance])
    //         ->with(['transaction' => $transaction]);
    // }   
}
