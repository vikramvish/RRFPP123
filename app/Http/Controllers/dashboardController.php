<?php

namespace App\Http\Controllers;

use App\Models\tbl_departmentmaster;
use App\Models\tbl_departmentmetadata;
use App\Models\tbl_departmentuser;
use App\Models\tbl_pgmaster;
use App\Models\tbl_pgrequestlog;
use App\Models\tbl_pgresponselog;
use App\Models\tbl_rolemaster;
use App\Models\tbl_schemeconfigration;
use App\Models\tbl_schememaster;
use App\Models\tbl_transactiondetail;
use App\Models\tbl_usermaster;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

// use ConsoleTVs\Charts\Facades\Charts;

class dashboardController extends Controller
{
    // public function index(Request $request)
    // {
    //     $departmentData = DB::table('tbl_schememasters')
    //         ->join('tbl_transactiondetails', 'tbl_transactiondetails.SchemeId', '=', 'tbl_schememasters.SchemeId')
    //         ->join('tbl_departmentmasters', 'tbl_departmentmasters.DepartmentId', '=', 'tbl_schememasters.DepartmentId')
    //         ->select('tbl_departmentmasters.DepartmentName', DB::raw('COUNT(tbl_transactiondetails.PRN) AS donation_count'), DB::raw('SUM(tbl_transactiondetails.TransactionAmount) AS donation_amount'))
    //         ->groupBy('tbl_departmentmasters.DepartmentName')
    //         ->get();

    //     $user = tbl_schememaster::join('tbl_transactiondetails', 'tbl_transactiondetails.SchemeId', '=', 'tbl_schememasters.SchemeId')->get(['tbl_transactiondetails.SchemeId', 'tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeNameHindi', 'tbl_transactiondetails.PRN', 'tbl_transactiondetails.SchemeId', 'tbl_transactiondetails.TransactionAmount', 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile', 'tbl_transactiondetails.created_at']);
    //     $dept = DB::table('tbl_schememasters')->get();
    //     $balance = DB::table('tbl_transactiondetails')
    //         ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
    //         ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
    //         ->sum('tbl_transactiondetails.TransactionAmount');

    //     $transaction = DB::table('tbl_transactiondetails')
    //         ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
    //         ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
    //         ->count();
    //     $count = DB::table('tbl_departmentmasters')->count();
    //     $schemes = DB::table('tbl_schememasters')->count();

    //     return view('nice-html/dashboard', compact('dept'))
    //         ->with(['user' => $user])
    //         ->with(['balance' => $balance])
    //         ->with(['count' => $count])
    //         ->with(['schemes' => $schemes])
    //         ->with(['transaction' => $transaction])
    //         ->with('departmentData', $departmentData);
    // }
    // public function index(Request $request)
    // {
    //     $roleId = session('roleId');
    //     $departmentId = session('departmentId');
    //     $countDepartment = 0;
    //     $countScheme = 0;
    //     $transactionCount = 0;
    //     $transactionAmount = 0;

    //     if ($roleId == 1) {
    //         // RoleId 1 - Show all department data
    //         $countDepartment = DB::table('tbl_departmentmasters')->count();
    //         $countScheme = DB::table('tbl_schememasters')->count();
    //         $transactionCount = DB::table('tbl_transactionpaymentdetails')->where('STATUS', 'SUCCESS')->count();
    //         $transactionAmount = DB::table('tbl_transactiondetails')
    //             ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
    //             ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
    //             ->sum('tbl_transactiondetails.TransactionAmount');

    //     } elseif (in_array($roleId, [2, 3, 4]) && $departmentId) {
    //         // RoleId 2, 3, or 4 - Show specific department data
    //         $countDepartment = 1; // Set to 1 for a specific department
    //         $countScheme = DB::table('tbl_schememasters')->where('DepartmentId', $departmentId)->count();
    //         $transactionCount = DB::table('tbl_departmentmasters AS DM')
    //             ->join('tbl_transactiondetails AS TD', 'TD.DepartmentId', '=', 'DM.DepartmentId')
    //             ->join('tbl_transactionpaymentdetails AS TP', 'TP.PRN', '=', 'TD.PRN')
    //             ->where('DM.DepartmentId', $departmentId)
    //             ->where('TP.STATUS', 'SUCCESS')
    //             ->count();
    //         $transactionAmount = DB::table('tbl_departmentmasters AS DM')
    //             ->join('tbl_transactiondetails AS TD', 'TD.DepartmentId', '=', 'DM.DepartmentId')
    //             ->join('tbl_transactionpaymentdetails AS TP', 'TP.PRN', '=', 'TD.PRN')
    //             ->where('DM.DepartmentId', $departmentId)
    //             ->where('TP.STATUS', 'SUCCESS')
    //             ->sum('TD.TransactionAmount');
    //     }

    //     return view('nice-html.dashboard')
    //         ->with('countDepartment', $countDepartment)
    //         ->with('countScheme', $countScheme)
    //         ->with('transactionCount', $transactionCount)
    //         ->with('transactionAmount', $transactionAmount);
    // }
    public function index(Request $request)
    {
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []); // Get an array of department IDs or an empty array if not set

        $countDepartment = 0;
        $countScheme = 0;
        $transactionCount = 0;
        $transactionAmount = 0;

        if ($roleId == 1) {
            // RoleId 1 - Show all department data
            $countDepartment = DB::table('tbl_departmentmasters')->count();
            $countScheme = DB::table('tbl_schememasters')->count();
            $transactionCount = DB::table('tbl_transactionpaymentdetails')->where('STATUS', 'SUCCESS')->count();
            $transactionAmount = DB::table('tbl_transactiondetails')
                ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
                ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
                ->sum('tbl_transactiondetails.TransactionAmount');
        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            // RoleId 2, 3, or 4 - Show specific department data
            $countDepartment = count($departmentIds); // Set the count of departments based on the number of IDs in the array
            $countScheme = DB::table('tbl_schememasters')->whereIn('DepartmentId', $departmentIds)->count();
            $transactionCount = DB::table('tbl_departmentmasters AS DM')
                ->join('tbl_transactiondetails AS TD', 'TD.DepartmentId', '=', 'DM.DepartmentId')
                ->join('tbl_transactionpaymentdetails AS TP', 'TP.PRN', '=', 'TD.PRN')
                ->whereIn('DM.DepartmentId', $departmentIds)
                ->where('TP.STATUS', 'SUCCESS')
                ->count();
            $transactionAmount = DB::table('tbl_departmentmasters AS DM')
                ->join('tbl_transactiondetails AS TD', 'TD.DepartmentId', '=', 'DM.DepartmentId')
                ->join('tbl_transactionpaymentdetails AS TP', 'TP.PRN', '=', 'TD.PRN')
                ->whereIn('DM.DepartmentId', $departmentIds)
                ->where('TP.STATUS', 'SUCCESS')
                ->sum('TD.TransactionAmount');
        }

        return view('nice-html.dashboard')
            ->with('countDepartment', $countDepartment)
            ->with('countScheme', $countScheme)
            ->with('transactionCount', $transactionCount)
            ->with('transactionAmount', $transactionAmount);
    }

    public function newdepartment()
    {
        return view('nice-html/add_new_dept');
    }
    public function register(Request $request)
    {
        $dept = new tbl_departmentmaster();
        $dept->DepartmentName = request('DepartmentName');
        $dept->DepartmentNameHindi = request('DepartmentNameHindi');
        $dept->IsActive = 1;
        $dept->save();
        return Redirect::back()->with('success', 'Department Added successfully!');
    }

    // public function newscheme()
    // {
    //     $roleId = session('roleId');
    //     $departmentId = session('departmentId');
    //     $countDepartment = 0;
    //     $countScheme = 0;
    //     $transactionCount = 0;
    //     $transactionAmount = 0;

    //     if ($roleId == 1) {
    //         $department = DB::table('tbl_departmentmasters')->get();
    //     } elseif (in_array($roleId, [2, 3, 4]) && $departmentId) {
    //         $department = DB::table('tbl_departmentmasters')
    //             ->where('DepartmentId', session('departmentId'))
    //             ->get();
    //     }
    //     return view('nice-html/add_new_scheme', compact('department'));
    // }
    public function newscheme()
    {
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []);

        if ($roleId == 1) {
            $department = DB::table('tbl_departmentmasters')->get();
        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $department = DB::table('tbl_departmentmasters')
                ->whereIn('DepartmentId', $departmentIds)
                ->get();
        } else {
            // If the user does not have access to view departments, you may handle this case as needed.
            // For example, redirect to a page displaying an appropriate error message.
            return redirect()->back()->with('fail', 'You do not have access to view departments.');
        }

        return view('nice-html/add_new_scheme', compact('department'));
    }

    public function insert(Request $request)
    {
        $dept = new tbl_schememaster();
        $dept->SchemeName = request('SchemeName');
        $dept->SchemeNameHindi = request('SchemeNameHindi');
        $dept->DepartmentId = request('department');
        $dept->IsActive = 1;
        $dept->save();

        return Redirect::back()->with('success', 'Scheme Added successfully!');
    }

    public function addSchDept()
    {
        $user = tbl_departmentmaster::join('tbl_departmentmetadatas', 'tbl_departmentmasters.DepartmentId', '=', 'tbl_departmentmetadatas.DepartmentId')->get(['tbl_departmentmetadatas.DepartmentId', 'tbl_departmentmasters.DepartmentName', 'tbl_departmentmetadatas.Slug', 'tbl_departmentmetadatas.Heading', 'tbl_departmentmetadatas.ShortDescription', 'tbl_departmentmetadatas.LongDescription', 'tbl_departmentmetadatas.Images']);
        // $balance = DB::table('tbl_transactiondetails')->sum('TransactionAmount');
        // $user = tbl_departmentmetadata::all();
        return view('nice-html/addSchDept', compact('user'));
    }

    public function deptcontent()
    {
        // $user = tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->first();
        // $user = tbl_departmentmaster::all();
        return view('nice-html/add_dept_content');
    }
    public function addnew(Request $request)
    {
        $request->validate([
            'ShortDescription' => 'required|max:400',
        ]);
        $desc = new tbl_departmentmetadata();
        $desc->Slug = $request->input('Slug');
        $desc->Heading = $request->input('Heading');
        $desc->ShortDescription = $request->input('ShortDescription');
        $desc->LongDescription = $request->input('LongDescription');
        if ($request->hasFile('Images')) {
            $file = $request->file('Images');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/department/', $filename);
            $desc->Images = $filename;
        }

        $desc->save();
        return redirect()
            ->back()
            ->with('success', 'New Department Save successfully');
    }
    public function edit($DepartmentId)
    {
        $user = tbl_departmentmetadata::firstOrNew(['DepartmentId' => $DepartmentId]);
        if (!$user) {
            $user = new tbl_departmentmetadata();
        }
        return view('nice-html/updateDepartment', compact('user'))->with('success', 'Configration Updated successfully');
    }

    public function savenew(Request $request, $DepartmentId)
    {
        $validator = Validator::make($request->all(), [
            'Slug' => 'required',
            'Heading' => 'required',
            'ShortDescription' => 'required|max:400',
            'LongDescription' => 'required|max:10000',
        ], [
            'Slug.required' => 'Slug is required.',
            'Heading.required' => 'Heading is required.',
            'ShortDescription.required' => 'Short Description can not be null.',
            'ShortDescription.max' => 'Short Description should not exceed 400 characters.',
            'LongDescription.required' => 'Long Description Can not be null.',
            'LongDescription.max' => 'Long Description should not exceed 10000 characters.',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        $desc = tbl_departmentmetadata::firstOrNew(['DepartmentId' => $DepartmentId]);

        $desc->Slug = $request->input('Slug');
        $desc->Heading = $request->input('Heading');
        $desc->LongDescription = $request->input('LongDescription');

        $shortDescription = $request->input('ShortDescription');
        $validator = Validator::make($request->all(), [
            'ShortDescription' => 'max:400',
        ], [
            'ShortDescription.max' => trans('validation.max.string'),
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $desc->ShortDescription = $shortDescription;

        if ($request->hasFile('Images')) {
            $destination = 'uploads/department/' . $desc->Images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('Images');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/department/', $filename);
            $desc->Images = $filename;
        }

        $desc->save();

        if ($desc->wasRecentlyCreated) {
            return redirect()
                ->back()
                ->with('success', 'Department Created successfully');
        } else {
            return redirect()
                ->back()
                ->with('success', 'Department Updated successfully');
        }
    }
    public function delete($DepartmentId)
    {
        tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->delete();
        return redirect()
            ->back()
            ->with('fail', 'You Have Deleted successfully');
    }

    public function IsActive(Request $request, $DepartmentId)
    {
        $model = tbl_departmentmetadata::find($DepartmentId);
        // $model-> IsActive = $IsActive;
        $model->save();
        return redirect()->back();
        // tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->delete();
        // return redirect()
        //     ->back()
        //     ->with('fail', 'You Have Deleted successfully');
    }
    public function IsActiveSch(Request $request, $SchemeId)
    {
        $model = tbl_schememaster::find($SchemeId);
        // $model-> IsActive = $IsActive;
        $model->save();
        return redirect()->back();
        // tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->delete();
        // return redirect()
        //     ->back()
        //     ->with('fail', 'You Have Deleted successfully');
    }

    public function deptedit(Request $request, $DepartmentId)
    {
        $this->validate($request, [
            'ShortDescription' => 'max:250',
        ]);

        $user = tbl_departmentmaster::where('DepartmentId', '=', $DepartmentId)->first();
        if (!$user) {
            abort(404, 'website.invalid_request');
        }
        return view('nice-html/DeptEdit', compact('user'))->with('success', 'Department Updated successfully');
    }

    // public function showdept()
    // {
    //     $roleId = session('roleId');
    //     $departmentId = session('departmentId');
    //     $countDepartment = 0;
    //     $countScheme = 0;
    //     $transactionCount = 0;
    //     $transactionAmount = 0;

    //     if ($roleId == 1) {
    //         $user = tbl_departmentmaster::all();

    //     } elseif (in_array($roleId, [2, 3, 4]) && $departmentId) {
    //         // RoleId 2, 3, or 4 - Show specific department data
    //         $user = DB::table('tbl_departmentmasters')
    //             ->select('DepartmentId', 'DepartmentName', 'DepartmentNameHindi', 'IsActive')
    //             ->where('DepartmentId', session('departmentId'))
    //             ->get();
    //         // dd($user);
    //     }

    //     return view('nice-html/departmentshow', compact('user'));
    // }
    public function showdept()
    {
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []);

        if ($roleId == 1) {
            $user = tbl_departmentmaster::all();
        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $user = DB::table('tbl_departmentmasters')
                ->select('DepartmentId', 'DepartmentName', 'DepartmentNameHindi', 'IsActive')
                ->whereIn('DepartmentId', $departmentIds)
                ->get();
        } else {
            // If the user does not have access to view departments, you may handle this case as needed.
            // For example, redirect to a page displaying an appropriate error message.
            return redirect()->back()->with('fail', 'You do not have access to view departments.');
        }

        return view('nice-html/departmentshow', compact('user'));
    }
    public function deptupdate(Request $request, $DepartmentId)
    {
        $dept = tbl_departmentmaster::findOrFail($DepartmentId); // can use fint insted of its give error
        $dept->DepartmentName = $request->input('DepartmentName');
        $dept->DepartmentNameHindi = $request->input('DepartmentNameHindi');
        $dept['IsActive'] = $request->has(key: 'IsActive');
        // $dept->IsActive = $request->has('IsActive') ? 1 : 0;
        $dept->update();
        return redirect()
            ->back()
            ->with('success', 'Department Update Successfully');
    }
    public function deletedept($DepartmentId)
    {
        tbl_departmentmaster::where('DepartmentId', '=', $DepartmentId)->delete();
        return redirect()
            ->back()
            ->with('fail', 'You Have Deleted successfully');
    }
    // public function showScheme(Request $request)
    // {
    //     $roleId = session('roleId');
    //     $departmentId = session('departmentId');
    //     $countDepartment = 0;
    //     $countScheme = 0;
    //     $transactionCount = 0;
    //     $transactionAmount = 0;

    //     if ($roleId == 1) {

    //         $dept = DB::table('tbl_departmentmasters')->get();
    //         $user = tbl_schememaster::join('tbl_departmentmasters', 'tbl_schememasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')->get(['tbl_schememasters.*', 'tbl_departmentmasters.DepartmentName']);

    //     } elseif (in_array($roleId, [2, 3, 4]) && $departmentId) {
    //         // RoleId 2, 3, or 4 - Show specific department data

    //         $dept = DB::table('tbl_departmentmasters')
    //             ->where('DepartmentId', session('departmentId'))
    //             ->get();
    //         $user = DB::table('tbl_schememasters as sm')
    //             ->join('tbl_departmentmasters as dm', 'sm.DepartmentId', '=', 'dm.DepartmentId')
    //             ->select('sm.SchemeId', 'sm.SchemeName', 'sm.SchemeNameHindi', 'dm.DepartmentName', 'sm.IsActive')
    //             ->where('dm.DepartmentId', session('departmentId'))
    //             ->get();
    //         // dd($user);
    //     }

    //     return view('nice-html/schemeshow', compact('user', 'dept'));
    // }
    public function showScheme(Request $request)
    {
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []);

        if ($roleId == 1) {
            $dept = DB::table('tbl_departmentmasters')->get();
            $user = tbl_schememaster::join('tbl_departmentmasters', 'tbl_schememasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')
                ->get(['tbl_schememasters.*', 'tbl_departmentmasters.DepartmentName']);
        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $dept = DB::table('tbl_departmentmasters')
                ->whereIn('DepartmentId', $departmentIds)
                ->get();

            $user = DB::table('tbl_schememasters as sm')
                ->join('tbl_departmentmasters as dm', 'sm.DepartmentId', '=', 'dm.DepartmentId')
                ->select('sm.SchemeId', 'sm.SchemeName', 'sm.SchemeNameHindi', 'dm.DepartmentName', 'sm.IsActive')
                ->whereIn('dm.DepartmentId', $departmentIds)
                ->get();
        } else {
            // If the user does not have access to view schemes, you may handle this case as needed.
            // For example, redirect to a page displaying an appropriate error message.
            return redirect()->back()->with('fail', 'You do not have access to view schemes.');
        }

        return view('nice-html/schemeshow', compact('user', 'dept'));
    }

    // public function schemeEdit($SchemeId)
    // {
    //     $user = tbl_schememaster::join('tbl_departmentmasters', 'tbl_schememasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')
    //         ->where('SchemeId', '=', $SchemeId)
    //         ->first();

    //     if (!$user) {
    //         abort(404, 'website.invalid_request');
    //     }
    //     $roleId = session('roleId');
    //     $departmentId = session('departmentId');
    //     $countDepartment = 0;
    //     $countScheme = 0;
    //     $transactionCount = 0;
    //     $transactionAmount = 0;
    //     if ($roleId == 1) {
    //         $departments = tbl_departmentmaster::all(); // Fetch all departments
    //     } elseif (in_array($roleId, [2, 3, 4]) && $departmentId) {
    //         $departments = DB::table('tbl_departmentmasters')
    //             ->where('DepartmentId', session('departmentId'))
    //             ->get();
    //         // $departments = tbl_departmentmaster::all();
    //     }
    //     return view('nice-html/SchemeEdit', compact('user', 'departments'))->with('success', 'Scheme Updated successfully');
    // }
    public function schemeEdit($SchemeId)
    {
        $user = tbl_schememaster::join('tbl_departmentmasters', 'tbl_schememasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')
            ->where('SchemeId', '=', $SchemeId)
            ->first();

        if (!$user) {
            abort(404, 'website.invalid_request');
        }

        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []);
        $countDepartment = 0;
        $countScheme = 0;
        $transactionCount = 0;
        $transactionAmount = 0;

        if ($roleId == 1) {
            $departments = tbl_departmentmaster::all(); // Fetch all departments
        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $departments = DB::table('tbl_departmentmasters')
                ->whereIn('DepartmentId', $departmentIds)
                ->get();
        } else {
            // If the user does not have access to view departments, you may handle this case as needed.
            // For example, redirect to a page displaying an appropriate error message.
            return redirect()->back()->with('fail', 'You do not have access to view departments.');
        }

        return view('nice-html/SchemeEdit', compact('user', 'departments'))->with('success', 'Scheme Updated successfully');
    }

    public function Schemeupdate(Request $request, $SchemeId)
    {
        // $tbl_schememaster->update([
        //     'SchemeName' => $request->SchemeName,
        //     'SchemeNameHindi' => $request->SchemeNameHindi,
        //     'DepartmentId' => $request->DepartmentId,
        //     'IsActive' => $request->has(key: 'IsActive')
        // ]);
        $scheme = tbl_schememaster::findOrFail($request->SchemeId);
        $scheme['IsActive'] = $request->has(key: 'IsActive');
        $scheme->update($request->all());
        return redirect()
            ->back()
            ->with('success', 'Scheme Update Successfully');

    }
    // public function SchConfigration()
    // {
    //     $roleId = session('roleId');
    //     $departmentId = session('departmentId');
    //     $countDepartment = 0;
    //     $countScheme = 0;
    //     $transactionCount = 0;
    //     $transactionAmount = 0;
    //     if ($roleId == 1) {
    //         $dept = DB::table('tbl_schememasters')->get();
    //         $user = tbl_schememaster::leftJoin('tbl_schemeconfigrations', 'tbl_schememasters.SchemeId', '=', 'tbl_schemeconfigrations.SchemeId')->get(['tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeId', 'tbl_schemeconfigrations.MerchantCode', 'tbl_schemeconfigrations.BankAccountNumber', 'tbl_schemeconfigrations.BankAccountIFSC']);
    //     } elseif (in_array($roleId, [2, 3, 4]) && $departmentId) {
    //         $dept = DB::table('tbl_schememasters')
    //             ->where('DepartmentId', session('departmentId'))
    //             ->get();
    //         $user = tbl_schememaster::leftJoin('tbl_schemeconfigrations', 'tbl_schememasters.SchemeId', '=', 'tbl_schemeconfigrations.SchemeId')
    //             ->where('DepartmentId', session('departmentId'))
    //             ->get(['tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeId', 'tbl_schemeconfigrations.MerchantCode', 'tbl_schemeconfigrations.BankAccountNumber', 'tbl_schemeconfigrations.BankAccountIFSC']);
    //     }

    //     return view('nice-html/SchConfigration', compact('user', 'dept'));
    // }
    public function SchConfigration()
    {
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []);
        $countDepartment = 0;
        $countScheme = 0;
        $transactionCount = 0;
        $transactionAmount = 0;

        if ($roleId == 1) {
            $dept = DB::table('tbl_schememasters')->get();
            $user = tbl_schememaster::leftJoin('tbl_schemeconfigrations', 'tbl_schememasters.SchemeId', '=', 'tbl_schemeconfigrations.SchemeId')
                ->get(['tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeId', 'tbl_schemeconfigrations.MerchantCode', 'tbl_schemeconfigrations.BankAccountNumber', 'tbl_schemeconfigrations.BankAccountIFSC']);
        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $dept = DB::table('tbl_schememasters')
                ->whereIn('DepartmentId', $departmentIds)
                ->get();
            $user = tbl_schememaster::leftJoin('tbl_schemeconfigrations', 'tbl_schememasters.SchemeId', '=', 'tbl_schemeconfigrations.SchemeId')
                ->whereIn('tbl_schememasters.DepartmentId', $departmentIds)
                ->get(['tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeId', 'tbl_schemeconfigrations.MerchantCode', 'tbl_schemeconfigrations.BankAccountNumber', 'tbl_schemeconfigrations.BankAccountIFSC']);
        } else {
            // If the user does not have access to view scheme configurations, you may handle this case as needed.
            // For example, redirect to a page displaying an appropriate error message.
            return redirect()->back()->with('fail', 'You do not have access to view scheme configurations.');
        }

        return view('nice-html/SchConfigration', compact('user', 'dept'));
    }

    public function addschConfig($SchemeId)
    {
        $user = tbl_schememaster::leftJoin('tbl_schemeconfigrations', 'tbl_schememasters.SchemeId', '=', 'tbl_schemeconfigrations.SchemeId')
            ->get(['tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeId', 'tbl_schemeconfigrations.MerchantCode', 'tbl_schemeconfigrations.BankAccountNumber', 'tbl_schemeconfigrations.BankAccountIFSC', 'tbl_schemeconfigrations.SchemeEncryptionKey', 'tbl_schemeconfigrations.SchemeChecksumKey', 'tbl_schemeconfigrations.BankAccountAddress', 'tbl_schemeconfigrations.BankAccountFilePath'])
            ->where('SchemeId', '==', $SchemeId)
            ->first();
        return view('nice-html/addSchConfigration', compact('user'))->with('success', 'Configration Updated successfully');
    }

    public function SchConfigrationUpdate(Request $request, $SchemeId)
    {
        $scheme = tbl_schemeconfigration::updateOrCreate(
            ['SchemeId' => $request->input('SchemeId')],
            [
                'MerchantCode' => $request->input('MerchantCode'),
                'BankAccountNumber' => $request->input('BankAccountNumber'),
                'BankAccountIFSC' => $request->input('BankAccountIFSC'),
                'SchemeEncryptionKey' => $request->input('SchemeEncryptionKey'),
                'SchemeChecksumKey' => $request->input('SchemeChecksumKey'),
                'BankAccountAddress' => $request->input('BankAccountAddress'),
                'BankAccountFilePath' => $request->input('BankAccountFilePath'),
            ],
        );
        // dd($scheme);
        return redirect()
            ->back()
            ->with('success', 'Bank Details Update Successfully');
    }

    // public function SSOmaping()
    // {
    //     $user = tbl_usermaster::join('tbl_rolemasters', 'tbl_usermasters.RoleId', '=', 'tbl_rolemasters.RoleId')
    //        ->get(['tbl_usermasters.*', 'tbl_rolemasters.RoleName']);

    //     return view('nice-html/SSOMaping', compact('user'));
    // }

    public function SSOmaping(Request $request)
    {
        $user = tbl_usermaster::with('departments')
            ->leftJoin('tbl_rolemasters', 'tbl_usermasters.RoleId', '=', 'tbl_rolemasters.RoleId')
            ->select('tbl_usermasters.*', 'tbl_rolemasters.RoleName')
            ->when($request->query('query'), function ($query, $search) {
                return $query->where('tbl_usermasters.UserName', 'like', '%' . $search . '%');
            })
            ->get();

        return view('nice-html/SSOMaping', compact('user'));
    }

    public function newSSO()
    {
        $role = DB::table('tbl_rolemasters')->get();
        $department = DB::table('tbl_departmentmasters')->get();
        return view('nice-html/AddSSOuser', compact('role', 'department'));
    }
    public function SSOinsert(Request $request)
    {
        $dept = new tbl_usermaster();
        $dept->UserName = request('UserName');
        $dept->displayName = request('displayName');
        $dept->designation = request('designation');
        $dept->RoleId = request('RoleId');
        $dept->IsActive = 1;
        $dept->DepartmentId = request('DepartmentId');
        $dept->save();

        // Insert into tbl_departmentusers
        $departmentUser = new tbl_departmentuser();
        $departmentUser->DepartmentId = request('DepartmentId');
        $departmentUser->user_id = $dept->user_id;
        $departmentUser->IsActive = 1;
        $departmentUser->save();

        return Redirect::back()->with('success', 'User Added successfully!');
    }
    public function userSSOEdit($id)
    {
        $user = tbl_usermaster::join('tbl_rolemasters', 'tbl_usermasters.RoleId', '=', 'tbl_rolemasters.RoleId')
            ->leftJoin('tbl_departmentmasters', 'tbl_usermasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')
            ->where('tbl_usermasters.user_id', '=', $id)
            ->select('tbl_usermasters.*', 'tbl_rolemasters.RoleName', 'tbl_departmentmasters.DepartmentName')
            ->first();
        if (!$user) {
            return response('User not found', 404);
        }
        $roles = tbl_rolemaster::all();
        $departments = tbl_departmentmaster::all();
        // $user = tbl_usermaster::where('id', '=', $id)->first();
        return view('nice-html/ssoEdit', compact('user', 'roles', 'departments'));
    }
    // public function deptmapping($userName)
    // {
    //     $user = tbl_usermaster::where('UserName', $userName)->first();
    //     if (!$user) {
    //         return response('User not found', 404);
    //     }
    //     $departments = tbl_departmentmaster::all();
    //     return view('nice-html/UserDeptMapping', compact('user', 'departments'));
    // }
    public function deptmapping($userName)
    {
        $user = tbl_usermaster::where('UserName', $userName)->first();
        if (!$user) {
            return response('User not found', 404);
        }
        $departments = tbl_departmentmaster::all();
        return view('nice-html/UserDeptMapping', compact('user', 'departments'));
    }
    // public function deptmappingUpdate(Request $request, $UserName)
    // {
    //     $user = tbl_usermaster::where('UserName', $UserName)->first();
    //     if (!$user) {
    //         return response('User not found', 404);
    //     }

    //     // Update the user's department in tbl_usermaster
    //     $user->DepartmentId = $request->input('department');
    //     $user->save();

    //     // Update the user's department mapping in tbl_departmentusers
    //     $departmentIds = $request->input('department');
    //     $user->departments()->sync($departmentIds);

    //     return Redirect::back()->with('success', 'User Department Mapping updated successfully!');
    // }
    public function deptmappingUpdate(Request $request, $UserName)
    {
        $user = tbl_usermaster::where('UserName', $UserName)->first();
        if (!$user) {
            return response('User not found', 404);
        }
        // $DepartmentId = $request->input('DepartmentId');
        // $user->DepartmentId = json_encode($DepartmentId);
        // Update the user's department in tbl_usermasters
        $user->save();

        // Update the user's department mappings in tbl_departmentusers
        $currentDateTime = Carbon::now();
        $departmentIds = $request->input('department');
        tbl_departmentuser::where('user_id', $user->user_id)->delete(); // Clear existing mappings
        $userDepartmentMappings = [];
        foreach ($departmentIds as $departmentId) {
            $userDepartmentMappings[] = [
                'user_id' => $user->user_id,
                'DepartmentId' => $departmentId,
                'IsActive' => $user->IsActive,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ];
        }

        tbl_departmentuser::insert($userDepartmentMappings); // Insert all records at once

        return Redirect::back()->with('success', 'User Department Mapping successfully!');
    }

    public function ssoupdate(Request $request, $user_id)
    {
        $scheme = tbl_usermaster::findOrFail($request->user_id);
        $scheme['IsActive'] = $request->has(key: 'IsActive');
        // $scheme->DepartmentId = $request->input('DepartmentId');
        $scheme->update($request->all());
        if (!$scheme) {
            return response('User not found', 404);
        }
        return redirect()
            ->back()
            ->with('success', 'User SSO Update Successfully');
    }

    //search transaction page start

    public function search(Request $request)
    {

        // $roleId = session('roleId');
        // $departmentId = session('departmentId');
        // $countDepartment = 0;
        // $countScheme = 0;
        // $transactionCount = 0;
        // $transactionAmount = 0;
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []);
        $countDepartment = 0;
        $countScheme = 0;
        $transactionCount = 0;
        $transactionAmount = 0;

        if ($roleId == 1) {
            $selectedDepartmentId = $request->input('department');
            $data = tbl_transactiondetail::query()
                ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
                ->join('tbl_schememasters', 'tbl_schememasters.SchemeId', '=', 'tbl_transactiondetails.SchemeId')
                ->select('tbl_schememasters.SchemeName', 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile', 'tbl_transactionpaymentdetails.created_at', 'tbl_transactionpaymentdetails.PRN', 'tbl_transactionpaymentdetails.STATUS', 'tbl_transactionpaymentdetails.AMOUNT');

            // Filter by from date
            if ($request->filled('from_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '>=', $request->input('from_date'));
            }

            // Filter by to date
            if ($request->filled('to_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '<=', $request->input('to_date'));
            }

            // Filter by department
            if ($request->filled('department') && $request->input('department') !== 'all') {
                $data->where('tbl_transactiondetails.DepartmentId', $request->input('department'));
            }

            // Filter by STATUS
            if ($request->filled('STATUS') && $request->input('STATUS') !== 'all') {
                $data->where('tbl_transactionpaymentdetails.STATUS', $request->input('STATUS'));
            }

            // Filter by scheme
            if ($request->filled('scheme') && $request->input('scheme') !== 'all') {
                $data->where('tbl_transactiondetails.SchemeId', $request->input('scheme'));
            }

            // Filter by RPPTxnId
            if ($request->filled('RPPTxnId')) {
                $data->whereDate('RPPTxnId', '<=', $request->input('RPPTxnId'));
            }

            // Filter by PGModeBID
            if ($request->filled('PGModeBID')) {
                $data->where('PGModeBID', $request->input('PGModeBID'));
            }

            // Filter by PayModeBankBID
            if ($request->filled('PayModeBankBID')) {
                $data->where('PayModeBankBID', $request->input('PayModeBankBID'));
            }

            // Filter by PRN number
            if ($request->filled('prn_number')) {
                $data->where('tbl_transactionpaymentdetails.PRN', $request->input('prn_number'));
            }

            // Filter by count
            if ($request->filled('count') && $request->input('count') !== 'all') {
                $count = $request->input('count');
                $data->limit($count);
            }

            $results = $data->get();
            $departments = tbl_departmentmaster::all();
            // Fetch the schemes corresponding to the selected department
            $selectedDepartment = tbl_departmentmaster::find($selectedDepartmentId);
            $schemes = $selectedDepartment ? $selectedDepartment->schemes : [];

            // $searched = ($request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number'));
            $count = $request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number') ? $results->count() : 0;

        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $selectedDepartmentId = $request->input('department') ?: $departmentIds; // Use the selected department ID if provided, otherwise use the session department ID
            $prn = $request->input('prn'); // Add this line to retrieve the PRN
            $count = 0;
            $selectedDepartmentId = $request->input('department');
            //  dd($selectedDepartmentId);
            // $data = tbl_transactiondetail::query()
            //     ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            //     ->select('tbl_transactiondetails.*', 'tbl_transactionpaymentdetails.*');
            $data = tbl_transactiondetail::query()
                ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
                ->join('tbl_schememasters', 'tbl_schememasters.SchemeId', '=', 'tbl_transactiondetails.SchemeId')
                ->select('tbl_schememasters.SchemeName', 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile', 'tbl_transactionpaymentdetails.created_at', 'tbl_transactionpaymentdetails.PRN', 'tbl_transactionpaymentdetails.STATUS', 'tbl_transactionpaymentdetails.AMOUNT');

            // Filter by from date
            if ($request->filled('from_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '>=', $request->input('from_date'));
            }

            // Filter by to date
            if ($request->filled('to_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '<=', $request->input('to_date'));
            }

            // Filter by department
            if ($request->filled('department') && $request->input('department') !== 'all') {
                $data->where('tbl_transactiondetails.DepartmentId', $request->input('department'));
            }

            // Filter by STATUS
            if ($request->filled('STATUS') && $request->input('STATUS') !== 'all') {
                $data->where('tbl_transactionpaymentdetails.STATUS', $request->input('STATUS'));
            }

            if ($request->filled('scheme') && $request->input('scheme') !== 'all') {
                $data->where('tbl_transactiondetails.SchemeId', $request->input('scheme'));
            }

            // Filter by RPPTxnId
            if ($request->filled('RPPTxnId')) {
                $data->whereDate('RPPTxnId', '<=', $request->input('RPPTxnId'));
            }

            // Filter by PGModeBID
            if ($request->filled('PGModeBID')) {
                $data->where('PGModeBID', $request->input('PGModeBID'));
            }

            // Filter by PayModeBankBID
            if ($request->filled('PayModeBankBID')) {
                $data->where('PayModeBankBID', $request->input('PayModeBankBID'));
            }

            // Filter by PRN number
            if ($request->filled('prn_number')) {
                $data->where('tbl_transactionpaymentdetails.PRN', $request->input('prn_number'));
            }

            // Filter by count
            if ($request->filled('count') && $request->input('count') !== 'all') {
                $count = $request->input('count');
                $data->limit($count);
            }

            $results = $data->get();
            $departments = tbl_departmentmaster::all();
            $schemes = tbl_schememaster::where('DepartmentId', $selectedDepartmentId)->get();

            $count = $request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number') ? $results->count() : 0;
        }
        return view('nice-html/searchTransaction', [
            'results' => $results,
            'roleId' => $roleId,
            'departmentIds' => $departmentIds,
            'departments' => $departments,
            'schemes' => $schemes,
            'count' => $count,
            'searched' => $count > 0,
            'selectedDepartmentId' => $selectedDepartmentId,
            'selectedCount' => $request->input('count'),
        ]);
    }

    //search transaction page end

    public function getSchemes(Request $request)
    {
        $departmentId = $request->input('departmentId');
        $schemes = tbl_schememaster::where('DepartmentId', $departmentId)->get();

        $options = '<option value="">All Scheme</option>';
        foreach ($schemes as $scheme) {
            $options .= '<option value="' . $scheme->SchemeId . '">' . $scheme->SchemeName . '</option>';
        }

        return $options;
    }

    public function txnlogs(Request $request)
    {
        $transactionId = $request->input('prn');
        $serviceType = $request->input('department');

        $query = DB::table('tbl_transactionpaymentdetails AS TPD')
            ->select('TPD.STATUS', 'PGS.created_at', 'PGR.EncryptedRequest', 'PGR.DecryptedRequest', 'PGS.EncryptedResponse', 'PGS.DecryptedResponse')
            ->join('tbl_pgrequestlogs AS PGR', 'TPD.PRN', '=', 'PGR.PRN')
            ->join('tbl_pgresponselogs AS PGS', 'PGR.RequestId', '=', 'PGS.RequestId')
            ->join('tbl_servicetypemasters AS STM', 'STM.ServiceTypeId', '=', 'PGR.ServiceTypeId')
            ->when($transactionId, function ($query, $transactionId) {
                return $query->where('TPD.PRN', $transactionId);
            })
            ->when($serviceType, function ($query, $serviceType) {
                if ($serviceType === 'Payment') {
                    return $query->where('STM.ServiceTypeName', 'Payment');
                } elseif ($serviceType === 'PENDING') {
                    return $query->where('TPD.STATUS', 'PENDING');
                } else {
                    return $query; // No specific service type selected, show all
                }
            })
            ->get();

        return view('nice-html/txn_logs', ['logsJson' => $query]);
    }

    public function refundlogs(Request $request)
    {
        return view('nice-html/refund_log');
    }
    public function refundinitilize(Request $request)
    {
        $prn = $request->input('query');
        if (empty($prn)) {
            return redirect()->back()->with('error', 'Please enter a PRN.')->withInput();
        }

        $data = DB::table('tbl_transactiondetails')
            ->select('tbl_transactiondetails.*', 'tbl_transactionpaymentdetails.*')
            ->leftJoin('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            ->where('tbl_transactiondetails.PRN', $prn)
            ->get();

        // Store the data in the session
        session(['refund_data' => $data]);
         // Retrieve the JSON data from the request and decode it
//          $requestData = json_decode($request->getContent(), true);

//          // Check if the JSON data contains the required keys
//          if (!isset($requestData['prn']) || !isset($requestData['rpptxnid']) || !isset($requestData['amount'])) {
//              return response()->json(['error' => 'Missing required data in the request.'], 400);
//          }
 
//          // Extract the individual values from the JSON data
//          $prn = $requestData['prn'];
//          $rpptxnid = $requestData['rpptxnid'];
//          $amount = $requestData['amount'];
 
//          // Prepare the API request data
//          $refundUrl = 'https://uat.rpp.rajasthan.gov.in/payments/v1/services/txnRefund';
//          $requestData = [
//              'MERCHANTCODE' => 'testMerchant2',
//              'PRN' => $prn,
//              'RPPTXNID' => $rpptxnid,
//              'APINAME' => 'TXNREFUND',
//              'AMOUNT' => $amount,
//              'SUBORDERID' => $prn,
//          ];
 
//          // Make the API call
//          $response = Http::asForm()->post($refundUrl, $requestData);
//         $apiResponse = $response->json();
// dd($apiResponse);
        // Store the API response in the session or return it to the view as needed
        // session(['refund_api_response' => $apiResponse]);

        return view('nice-html/refund_log', [
            'data' => $data,
            'prn' => $prn,
            // 'apiResponse' => $apiResponse,
        ]);
    }
    public function refundResponse(Request $request)
    {
        $prn = $request->input('prn');
        $rpptxnid = $request->input('rpptxnid');
        $amount = $request->input('amount');

        $refundUrl = 'https://uat.rpp.rajasthan.gov.in/payments/v1/services/txnRefund.json';

        $requestData = [
            'MERCHANTCODE' => 'testMerchant2',
            'PRN' => $prn,
            'RPPTXNID' => $rpptxnid,            
            'AMOUNT' => $amount,
            'SUBORDERID' => $prn,
            'APINAME' => 'TXNREFUND',
        ];
        // dd($requestData);
        $response = Http::asForm()->post($refundUrl, $requestData);
        $responseData = $response->json();
      
        // You can pass the $response data to the view if needed
        return view('nice-html/refund_response', ['response' => $responseData]);
    }
//download report page start
    public function downloadReports(Request $request)
    {
        // $roleId = session('roleId');
        // $departmentId = session('departmentId');
        // $countDepartment = 0;
        // $countScheme = 0;
        // $transactionCount = 0;
        // $transactionAmount = 0;
        $roleId = session('roleId');
        $departmentIds = session('departmentIds', []); // Make sure this variable is defined and has a value
        $countDepartment = 0;
        $countScheme = 0;
        $transactionCount = 0;
        $transactionAmount = 0;

        if ($roleId == 1) {
            $prn = $request->input('prn'); // Add this line to retrieve the PRN
            $count = 0;
            $selectedDepartmentId = $request->input('department');
            $data = tbl_transactiondetail::query()
                ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
                ->select('tbl_transactiondetails.*', 'tbl_transactionpaymentdetails.*');

            // Filter by from date
            if ($request->filled('from_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '>=', $request->input('from_date'));
            }

            // Filter by to date
            if ($request->filled('to_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '<=', $request->input('to_date'));
            }

            // Filter by department
            if ($request->filled('department')) {
                $data->where('DepartmentId', $request->input('department'));
            }
            // Filter by status
            if ($request->filled('STATUS')) {
                $data->where('STATUS', $request->input('STATUS'));
            }

            // Filter by scheme
            if ($request->filled('scheme')) {
                $data->where('SchemeId', $request->input('scheme'));
            }

            // Filter by count
            if ($request->filled('count') && $request->input('count') !== 'all') {
                $count = $request->input('count');
                $data->limit($count);
            }

            $results = $data->get();
            $departments = tbl_departmentmaster::all();

            $schemes = tbl_schememaster::where('DepartmentId', $selectedDepartmentId)->get();

            // Fetch the PGNames corresponding to the PGIds in the results
            $pgIds = $results->pluck('PGID')->toArray();

            // Fetch the PGNames corresponding to the PGIds in the results
            $pgNames = tbl_pgmaster::join('tbl_transactionpaymentdetails', 'tbl_pgmasters.PGId', '=', 'tbl_transactionpaymentdetails.PGID')
                ->pluck('tbl_pgmasters.PGName', 'tbl_transactionpaymentdetails.PGID')
                ->toArray();

            $count = $request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number') ? $results->count() : 0;
            if ($request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme')) {
                $count = $results->count();
            }

        } elseif (in_array($roleId, [2, 3, 4]) && count($departmentIds) > 0) {
            $selectedDepartmentId = $request->input('department') ?: $departmentIds;

            $prn = $request->input('prn'); // Add this line to retrieve the PRN
            $count = 0;
            $selectedDepartmentId = $request->input('department');
            $data = tbl_transactiondetail::query()
                ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
                ->select('tbl_transactiondetails.*', 'tbl_transactionpaymentdetails.*');

            // Filter by from date
            if ($request->filled('from_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '>=', $request->input('from_date'));
            }

            // Filter by to date
            if ($request->filled('to_date')) {
                $data->whereDate('tbl_transactionpaymentdetails.created_at', '<=', $request->input('to_date'));
            }

            // Filter by department
            // if ($request->filled('department')) {
            //     $data->where('DepartmentId', $request->input('department'));
            // }
            if ($request->filled('department')) {
                $data->where('tbl_transactiondetails.DepartmentId', $request->input('department'));
            }

            // Filter by status
            if ($request->filled('STATUS')) {
                $data->where('STATUS', $request->input('STATUS'));
            }

            // Filter by scheme
            if ($request->filled('scheme')) {
                $data->where('SchemeId', $request->input('scheme'));
            }

            // Filter by count
            if ($request->filled('count') && $request->input('count') !== 'all') {
                $count = $request->input('count');
                $data->limit($count);
            }

            $results = $data->get();
            $departments = tbl_departmentmaster::all();

            $schemes = tbl_schememaster::where('DepartmentId', $selectedDepartmentId)->get();

            // Fetch the PGNames corresponding to the PGIds in the results
            $pgIds = $results->pluck('PGID')->toArray();

            // Fetch the PGNames corresponding to the PGIds in the results
            $pgNames = tbl_pgmaster::join('tbl_transactionpaymentdetails', 'tbl_pgmasters.PGId', '=', 'tbl_transactionpaymentdetails.PGID')
                ->pluck('tbl_pgmasters.PGName', 'tbl_transactionpaymentdetails.PGID')
                ->toArray();

            $count = $request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number') ? $results->count() : 0;

            if ($request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme')) {
                $count = $results->count();
            }
        }
        return view('nice-html/downloadReports', [
            'results' => $results,
            'departments' => $departments,
            'schemes' => $schemes,
            'count' => $count,
            'roleId' => $roleId,
            'departmentIds' => $departmentIds,
            'pgNames' => $pgNames,
            'searched' => $count > 0,
            'selectedDepartmentId' => $selectedDepartmentId,
            'request' => $request,
            'selectedCount' => $request->input('count'),
        ]);
    }

    public function submitVerifyForm(Request $request)
    {

        // Get the PRN and AMOUNT values from the form submission
        $merchantCode = 'testMerchant2';
        $prn = $request->input('PRN');
        $amount = $request->input('AMOUNT');

        // Fetch the data from the two tables using a join
        $requestData = DB::table('tbl_transactionpaymentdetails')
            ->join('tbl_transactiondetails', 'tbl_transactionpaymentdetails.PRN', '=', 'tbl_transactiondetails.PRN')
            ->select('tbl_transactionpaymentdetails.*', 'tbl_transactiondetails.*')
            ->where('tbl_transactionpaymentdetails.PRN', $prn)
            ->first();

        $verifyServiceType = 'Verify'; // Assuming the ServiceTypeName is 'Verify'

        $serviceType = DB::table('tbl_servicetypemasters')
            ->where('ServiceTypeName', $verifyServiceType)
            ->value('ServiceTypeId');

        // Create a plain string using the fetched data
        $DecryptedRequest = '{
            "REQTIMESTAMP":"' . $requestData->REQTIMESTAMP . '",
            "RemitterName":"' . $requestData->RemitterName . '",
            "AMOUNT":"' . $amount . '",
            "PRN":"' . $prn . '",
            "MERCHANTCODE":"' . $merchantCode . '",
            "RemitterMobile":"' . $requestData->RemitterMobile . '",
            "SchemeId":"' . $requestData->SchemeId . '",
            "DepartmentId":"' . $requestData->DepartmentId . '",
            "RPPTxnId":"' . $requestData->RPPTxnId . '",
            "RPPTIMESTAMP":"' . $requestData->RPPTIMESTAMP . '",
            "CHECKSUM":"' . $requestData->CHECKSUM . '",
            "PGModeBID":"' . $requestData->PGModeBID . '",
            "PayModeBankName":"' . $requestData->PayModeBankName . '"
        }';

        // Encrypt the plain string
        $encryption = new Aes256Encryption();
        $encryption->setKey('9759E1886FB5766DA58FF17FF8DD4');
        $encryptedString = $encryption->encrypt($DecryptedRequest);

        // Save the encryptedString to the tbl_pgrequestlogs table
        $requestLog = new tbl_pgrequestlog();
        $requestLog->PRN = $prn;
        $requestLog->ServiceTypeId = $serviceType;
        $requestLog->DecryptedRequest = $DecryptedRequest;
        $requestLog->EncryptedRequest = $encryptedString;
        $requestLog->SchemeId = $requestData->SchemeId;
        $requestLog->PGId = $requestData->PGID;
        $requestLog->TransactionAmount = $requestData->TransactionAmount;
        $requestLog->save();
        $requestLog->refresh();
        // Retrieve the RequestId after saving the request in tbl_pgrequestlog
        $requestId = $requestLog->RequestId;
        $requestLog = tbl_pgrequestlog::where('RequestId', $requestId)->first();
        $response = Http::asForm()->post('https://uat.rpp.rajasthan.gov.in/payments/v1/services/txnStatus', [
            'MERCHANTCODE' => 'testMerchant2',
            'PRN' => $request->input('PRN'),
            'AMOUNT' => $request->input('AMOUNT'),
        ]);

        $jsonData = json_encode($response->json());

        // Save the response data to tbl_pgresponselogs
        $responseLog = new tbl_pgresponselog();
        $responseLog->RequestId = $requestId; // Use the retrieved RequestId

        $responseLog->DecryptedResponse = $jsonData;
        // Encrypt the response data
        $encryption->setKey('9759E1886FB5766DA58FF17FF8DD4');
        $encryptedResponse = $encryption->encrypt($jsonData);

        $responseLog->EncryptedResponse = $encryptedResponse;
        $responseLog->save();

        $responseData = $response->json();

        if ($responseData['STATUS'] == 'SUCCESS') {
            // Check if the existing status is not already 'SUCCESS'
            if ($requestData->STATUS != 'SUCCESS') {
                // Update the table tbl_transactionpaymentdetails for the corresponding PRN
                DB::table('tbl_transactionpaymentdetails')
                    ->where('PRN', $prn)
                    ->update(['STATUS' => $responseData['STATUS']]);
            }
            session()->flash('alert', 'Transaction Successful.');
            session()->flash('alert-class', "success");
        } elseif ($responseData['STATUS'] == 'FAILED') {
            session()->flash('alert', 'Transaction Found Failed.');
            session()->flash('alert-class', "warning");
        }
        return redirect()->back();
        //  return view('nice-html/verify')->with('jsonData', $jsonData);
    }

    public function getReport(Request $request)
    {
        $departmentId = $request->input('departmentId');
        $schemes = tbl_schememaster::where('DepartmentId', $departmentId)->get();

        $options = '<option value="">All Scheme</option>';
        foreach ($schemes as $scheme) {
            $options .= '<option value="' . $scheme->SchemeId . '">' . $scheme->SchemeName . '</option>';
        }
        return $options;
    }

//download report page end

    public function pdfformat(Request $request)
    {
        $prn = $request->query('prn');

        $data = tbl_transactiondetail::join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            ->where('tbl_transactiondetails.PRN', $prn)
            ->select('tbl_transactiondetails.*', 'tbl_transactionpaymentdetails.*')
            ->first();

        if (!$data) {
            abort(404); // Return a 404 error response if the PRN is invalid or not found
        }

        return view('nice-html/PdfFormat', compact('prn', 'data'));
    }
    public function pdf(Request $request)
    {
        $prn = $request->query('prn');

        $data = tbl_transactiondetail::join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            ->where('tbl_transactiondetails.PRN', $prn)
            ->select('tbl_transactiondetails.*', 'tbl_transactionpaymentdetails.*')
            ->first();

        if (!$data) {
            abort(404); // Return a 404 error response if the PRN is invalid or not found
        }

        return view('nice-html/Pdf', compact('prn', 'data'));
    }
    public function handle404(Request $request)
    {
        return view('website.invalid_request');
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
