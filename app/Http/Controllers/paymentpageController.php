<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect; //  Redirect to a given Laravel URL
use Illuminate\Support\str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\tbl_transactiondetail;
use App\Models\tbl_departmentmetadata;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\CommonControllerFunctions;

class paymentpageController extends Controller
{
    public function index($slug)
    {
        $collections = tbl_departmentmetadata::where('slug', $slug)->first();  
        $department_id = $collections->DepartmentId;      
        // $scheme = DB::table('tbl_schememasters')->get();
        $scheme = DB::table('tbl_schememasters')->where('DepartmentId', $department_id)->get();
        // $dept = DB::table('tbl_departmentmasters')->get();
        return view('website/paymentpage', compact('collections', 'scheme','slug'));
    }
    public function Register(Request $request)
    {        
        $PRN  = random_int(1000000, 9999999);      
        // $PRN  = rand(7); 
        $encodedPRN = base64_encode($PRN);
        Session::put('txnid', $encodedPRN);  
        $selectedScheme = DB::table('tbl_schememasters')->where('SchemeId', $request->scheme)->first();
        return view('website/preview',compact('PRN','selectedScheme'));
    }
    public function AnnonmousPreview(Request $request)
    {        
        $PRN  = random_int(1000000, 9999999);      
        // $PRN  = rand(7); 
        $encodedPRN = base64_encode($PRN);
        Session::put('txnid', $encodedPRN);  
        $selectedScheme = DB::table('tbl_schememasters')->where('SchemeId', $request->scheme)->first();
        return view('website/previewAnnonmous',compact('PRN','selectedScheme'));
    }
}
