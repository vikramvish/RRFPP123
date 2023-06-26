<?php

namespace App\Http\Controllers;

use App\Models\tbl_departmentmaster;
use App\Models\tbl_departmentmetadata;
use App\Models\tbl_pgmaster;
use App\Models\tbl_pgrequestlog;
use App\Models\tbl_pgresponselog;
use App\Models\tbl_rolemaster;
use App\Models\tbl_schemeconfigration;
use App\Models\tbl_schememaster;
use App\Models\tbl_transactiondetail;
use App\Models\tbl_usermaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class dashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = tbl_schememaster::join('tbl_transactiondetails', 'tbl_transactiondetails.SchemeId', '=', 'tbl_schememasters.SchemeId')->get(['tbl_transactiondetails.SchemeId', 'tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeNameHindi', 'tbl_transactiondetails.PRN', 'tbl_transactiondetails.SchemeId', 'tbl_transactiondetails.TransactionAmount', 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile', 'tbl_transactiondetails.created_at']);
        $dept = DB::table('tbl_schememasters')->get();
        $balance = DB::table('tbl_transactiondetails')
            ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
            ->sum('tbl_transactiondetails.TransactionAmount');

        $transaction = DB::table('tbl_transactiondetails')
            ->join('tbl_transactionpaymentdetails', 'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
            ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
            ->count();
        $count = DB::table('tbl_departmentmasters')->count();
        $schemes = DB::table('tbl_schememasters')->count();

        return view('nice-html/dashboard', compact('dept'))
            ->with(['user' => $user])
            ->with(['balance' => $balance])
            ->with(['count' => $count])
            ->with(['schemes' => $schemes])
            ->with(['transaction' => $transaction]);
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

    public function newscheme()
    {
        $department = DB::table('tbl_departmentmasters')->get();
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
            'ShortDescription' => 'required|max:500',
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
        $desc = tbl_departmentmetadata::firstOrNew(['DepartmentId' => $DepartmentId]);

        $desc->Slug = $request->input('Slug');
        $desc->Heading = $request->input('Heading');
        $desc->ShortDescription = $request->input('ShortDescription');
        $desc->LongDescription = $request->input('LongDescription');

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

    public function showdept()
    {
        $user = tbl_departmentmaster::all();
        return view('nice-html/departmentshow', compact('user'));
    }
    public function deptupdate(Request $request, $DepartmentId)
    {
        $dept = tbl_departmentmaster::findOrFail($DepartmentId); // can use fint insted of its give error
        $dept->DepartmentName = $request->input('DepartmentName');
        $dept->DepartmentNameHindi = $request->input('DepartmentNameHindi');
        $dept['IsActive'] = $request->has(key:'IsActive');
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
    public function showScheme(Request $request)
    {
        // if($request->prorities) {
        //     $user = tbl_schememaster::where('prorities',$request->prorities)->get();
        //     return response()->json(['data' => $members]);
        //   } else {
        //     $user = tbl_schememaster::get();
        //     return response()->json(['data' => $members]);
        //   }

        $dept = DB::table('tbl_departmentmasters')->get();
        $user = tbl_schememaster::join('tbl_departmentmasters', 'tbl_schememasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')->get(['tbl_schememasters.*', 'tbl_departmentmasters.DepartmentName']);
        // $user = tbl_schememaster::all();
        return view('nice-html/schemeshow', compact('user', 'dept'));
    }
    public function schemeEdit($SchemeId)
    {
        $user = tbl_schememaster::join('tbl_departmentmasters', 'tbl_schememasters.DepartmentId', '=', 'tbl_departmentmasters.DepartmentId')
            ->where('SchemeId', '=', $SchemeId)
            ->first();

        if (!$user) {
            abort(404, 'website.invalid_request');
        }

        $departments = tbl_departmentmaster::all(); // Fetch all departments

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
        $scheme['IsActive'] = $request->has(key:'IsActive');
        $scheme->update($request->all());
        return redirect()
            ->back()
            ->with('success', 'Scheme Update Successfully');

        // $scheme = tbl_schememaster::find($SchemeId);
        // $scheme->SchemeName = $request->input('SchemeName');
        // $scheme->SchemeNameHindi = $request->input('SchemeNameHindi');
        // $scheme->DepartmentId = $request->input('DepartmentName');
        // $scheme['IsActive'] = $request->has(key: 'IsActive');
        // // $request->has('IsActive');
        // $scheme->update();
        // return redirect()
        //     ->back()
        //     ->with('success', 'Scheme Update Successfully');
    }
    public function SchConfigration()
    {
        $dept = DB::table('tbl_schememasters')->get();
        $user = tbl_schememaster::leftJoin('tbl_schemeconfigrations', 'tbl_schememasters.SchemeId', '=', 'tbl_schemeconfigrations.SchemeId')->get(['tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeId', 'tbl_schemeconfigrations.MerchantCode', 'tbl_schemeconfigrations.BankAccountNumber', 'tbl_schemeconfigrations.BankAccountIFSC']);

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

        // $scheme = tbl_schemeconfigration::find($SchemeId);
        // // $scheme->SchemeId = request('SchemeId');
        //  $scheme->SchemeId = $request->input('SchemeId');
        // // $scheme->SchemeId = $request->input('SchemeId');
        // $scheme->MerchantCode = $request->input('MerchantCode');
        // $scheme->BankAccountNumber = $request->input('BankAccountNumber');
        // $scheme->BankAccountIFSC = $request->input('BankAccountIFSC');
        // $scheme->update();
        // dd($scheme);
        // return redirect()
        //     ->back()
        //     ->with('success', 'Scheme Update Successfully');
    }

    // public function SSOmaping()
    // {
    //     $user = tbl_usermaster::join('tbl_rolemasters', 'tbl_usermasters.RoleId', '=', 'tbl_rolemasters.RoleId')
    //        ->get(['tbl_usermasters.*', 'tbl_rolemasters.RoleName']);

    //     return view('nice-html/SSOMaping', compact('user'));
    // }

    public function SSOmaping(Request $request)
    {
        $user = tbl_usermaster::join('tbl_rolemasters', 'tbl_usermasters.RoleId', '=', 'tbl_rolemasters.RoleId')
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
        return view('nice-html/AddSSOuser', compact('role'));
    }
    public function SSOinsert(Request $request)
    {
        $dept = new tbl_usermaster();
        $dept->UserName = request('UserName');
        $dept->displayName = request('displayName');
        $dept->designation = request('designation');
        $dept->RoleId = request('RoleId');
        $dept->IsActive = 1;
        $dept->save();

        return Redirect::back()->with('success', 'User Added successfully!');
    }
    public function userSSOEdit($id)
    {
        $user = tbl_usermaster::join('tbl_rolemasters', 'tbl_usermasters.RoleId', '=', 'tbl_rolemasters.RoleId')
            ->where('tbl_usermasters.id', '=', $id)
            ->select('tbl_usermasters.*', 'tbl_rolemasters.RoleName')
            ->first();
        $roles = tbl_rolemaster::all();
        // $user = tbl_usermaster::where('id', '=', $id)->first();
        return view('nice-html/ssoEdit', compact('user', 'roles'))->with('success', 'user SSO Updated successfully');
    }
    public function ssoupdate(Request $request, $id)
    {
        $scheme = tbl_usermaster::findOrFail($request->id);
        $scheme['IsActive'] = $request->has(key:'IsActive');
        $scheme->update($request->all());
        return redirect()
            ->back()
            ->with('success', 'User SSO Update Successfully');
    }

//search transaction page start

    public function search(Request $request)
    {
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
        if ($request->filled('department') && $request->input('department') !== 'all') {
            $data->where('DepartmentId', $request->input('department'));
        }

        // Filter by STATUS
        if ($request->filled('STATUS') && $request->input('STATUS') !== 'all') {
            $data->where('tbl_transactionpaymentdetails.STATUS', $request->input('STATUS'));
        }

        if ($request->filled('scheme') && $request->input('scheme') !== 'all') {
            $data->where('SchemeId', $request->input('scheme'));
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

        // $searched = ($request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number'));
        $count = $request->filled('from_date') || $request->filled('to_date') || $request->filled('department') || $request->filled('STATUS') || $request->filled('scheme') || $request->filled('RPPTxnId') || $request->filled('PGModeBID') || $request->filled('PayModeBankBID') || $request->filled('prn_number') ? $results->count() : 0;
        return view('nice-html/searchTransaction', [
            'results' => $results,
            'departments' => $departments,
            'schemes' => $schemes,
            'count' => $count,
            'searched' => $count > 0,
            'selectedDepartmentId' => $selectedDepartmentId,
            'selectedCount' => $request->input('count'),
        ]);
    }
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

    // public function txnlogs(Request $request)
    // {
    //     $transactionId = $request->input('txnid');

    //     $logs = DB::table('tbl_transactionpaymentdetails AS TPD')
    //         ->select('TPD.STATUS','PGS.created_at', 'PGR.EncryptedRequest', 'PGR.DecryptedRequest', 'PGS.EncryptedResponse', 'PGS.DecryptedResponse')
    //         ->Join('tbl_pgrequestlogs AS PGR', 'TPD.PRN', '=', 'PGR.PRN')
    //         ->Join('tbl_pgresponselogs AS PGS', 'PGR.RequestId', '=', 'PGS.RequestId')
    //         ->where('TPD.RPPTxnId', $transactionId)
    //         ->get();

    //     return view('nice-html/txn_logs', ['logsJson' => $logs]);
    // }
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
//search transaction page end

//download report page start
    public function downloadReports(Request $request)
    {
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

        return view('nice-html/downloadReports', ['results' => $results,
            'departments' => $departments,
            'schemes' => $schemes,
            'count' => $count,
            'pgNames' => $pgNames, // Add the pgNames variable to the view
            'searched' => $count > 0,
            'selectedDepartmentId' => $selectedDepartmentId,
            'request' => $request,
            'selectedCount' => $request->input('count')]);
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
        // $requestId = $requestLog->RequestId;
        $response = Http::asForm()->post('https://uat.rpp.rajasthan.gov.in/payments/v1/services/txnStatus', [
            'MERCHANTCODE' => 'testMerchant2',
            'PRN' => $request->input('PRN'),
            'AMOUNT' => $request->input('AMOUNT'),
        ]);

        $jsonData = json_encode($response->json());

        // Save the response data to tbl_pgresponselogs
        $responseLog = new tbl_pgresponselog();
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
