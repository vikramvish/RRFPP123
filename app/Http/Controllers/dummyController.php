<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_transactiondetail;
use App\Models\form1;
use App\Models\tbl_departmentmetadata;
use App\Models\tbl_schememaster;
use App\Models\tbl_departmentmaster;
class dummyController extends Controller
{
    public function list()
    {
        $categories = tbl_transactiondetail::all();
        return response()->json($categories);
    }
    public function listData(Request $request)
    {
        $request->validate([
            'Request_Id' => 'required',
            'Month_Name' => 'required',
            'department' => 'required',
            'Transaction_ID' => 'required',
            'PRN' => 'required',
            'MERCHANTCODE' => 'required',
            'REQTIMESTAMP' => 'required',
            'PURPOSE' => 'required',
            'Donnar_Name' => 'required',
            'Donnar_pan' => 'required',
            'Donnar_Address' => 'required',
            'Donnar_Email_id' => 'required',
            'Mobile_No' => 'required',
            'Donnar_Amount' => 'required',
            'SUCCESSURL' => 'required',

            'FAILUREURL' => 'required',
            'CANCELURL' => 'required',
            'CALLBACKURL' => 'required',
            'UDF1' => 'required',
            'UDF2' => 'required',
            'UDF3' => 'required',
            'OFFICECODE' => 'required',
            'REVENUEHEAD' => 'required',
            'CHECKSUM' => 'required',
            'ENCDATA' => 'required',
            'PLAINDATA' => 'required',
            'CURRENCY' => 'required',
        ]);
        $user = new tbl_transactiondetail();
        $user->Request_Id = $request->Request_Id;
        $user->Month_Name = $request->Month_Name;
        $user->department = $request->department;
        $user->Transaction_ID = $request->Transaction_ID;
        $user->PRN = $request->PRN;
        $user->MERCHANTCODE = $request->MERCHANTCODE;
        $user->REQTIMESTAMP = $request->REQTIMESTAMP;
        $user->PURPOSE = $request->PURPOSE;
        $user->Donnar_Name = $request->Donnar_Name;
        $user->Donnar_pan = $request->Donnar_pan;
        $user->Donnar_Address = $request->Donnar_Address;
        $user->Donnar_Email_id = $request->Donnar_Email_id;
        $user->Mobile_No = $request->Mobile_No;
        $user->Donnar_Amount = $request->Donnar_Amount;
        $user->SUCCESSURL = $request->SUCCESSURL;
        $user->FAILUREURL = $request->FAILUREURL;
        $user->CANCELURL = $request->CANCELURL;
        $user->CALLBACKURL = $request->CALLBACKURL;
        $user->UDF1 = $request->UDF1;
        $user->UDF2 = $request->UDF2;
        $user->UDF3 = $request->UDF3;
        $user->OFFICECODE = $request->OFFICECODE;
        $user->REVENUEHEAD = $request->REVENUEHEAD;
        $user->CHECKSUM = $request->CHECKSUM;
        $user->ENCDATA = $request->ENCDATA;
        $user->PLAINDATA = $request->PLAINDATA;
        $user->CURRENCY = $request->CURRENCY;

        $res = $user->save();
        if ($res) {
            return back()->with('success', 'Data insert successfully');
        } else {
            return back()->with('fail', 'Somthing Wrong');
        }
    }
    public function mataData(Request $request)
    {
        // Retrieve data from the database
        $data = tbl_departmentmetadata::all();

        // Return JSON response
        return response()->json($data);
    }
    public function SchemeData(Request $request)
    {
        // Retrieve data from the database
        $data = tbl_schememaster::all();

        // Return JSON response
        return response()->json($data);
    }
    public function DeptData(Request $request)
    {
        // Retrieve data from the database
        $data = tbl_departmentmaster::all();

        // Return JSON response
        return response()->json($data);
    }
}
