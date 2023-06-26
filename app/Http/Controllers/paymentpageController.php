<?php

namespace App\Http\Controllers;

use App\Models\tbl_departmentmetadata; //  Redirect to a given Laravel URL
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class paymentpageController extends Controller
{
    public function index($slug)
    {
        try {
            // $collections = tbl_departmentmetadata::where('slug', $slug)->first();
            $collections = tbl_departmentmetadata::where('slug', $slug)->firstOrFail();
            $department_id = $collections->DepartmentId;

            $scheme = DB::table('tbl_schememasters')
                ->where('DepartmentId', $department_id)
                ->where('IsActive', 1)
                ->get();

            return view('website/paymentpage', compact('collections', 'scheme', 'slug'));
        } catch (QueryException $e) {
            // Log the exception for debugging purposes
            Log::error('Error retrieving data from the database: ' . $e->getMessage());

            // Return an error response or redirect the user to an error page
            return view('website/invalid_page'); // Replace 'error-page' with your actual error page view
        }
    }
    public function Register(Request $request)
    {
        $PRN = random_int(1000000, 9999999);
        // $PRN  = rand(7);
        $encodedPRN = base64_encode($PRN);
        Session::put('txnid', $encodedPRN);
        $selectedScheme = DB::table('tbl_schememasters')->where('SchemeId', $request->scheme)->first();
        return view('website/preview', compact('PRN', 'selectedScheme'));
    }
    public function AnnonmousPreview(Request $request)
    {
        $PRN = random_int(1000000, 9999999);
        // $PRN  = rand(7);
        $encodedPRN = base64_encode($PRN);
        Session::put('txnid', $encodedPRN);
        $selectedScheme = DB::table('tbl_schememasters')->where('SchemeId', $request->scheme)->first();
        return view('website/previewAnnonmous', compact('PRN', 'selectedScheme'));
    }
}
