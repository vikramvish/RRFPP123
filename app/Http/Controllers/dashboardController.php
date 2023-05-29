<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\tbl_departmentmetadata;
use App\Models\tbl_transactiondetail;
use App\Models\tbl_departmentmaster;
use App\Models\tbl_schememaster;
use App\Models\tbl_usermaster;
use App\Models\tbl_rightmaster;
use App\Models\tbl_roleright;
use App\Models\tbl_rolemaster;
use App\Models\tbl_schemeconfigration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class dashboardController extends Controller
{
    public function index(Request $request)
    {       
        $user = tbl_schememaster::join('tbl_transactiondetails', 'tbl_transactiondetails.SchemeId', '=', 'tbl_schememasters.SchemeId')->get(['tbl_transactiondetails.SchemeId', 'tbl_schememasters.SchemeName', 'tbl_schememasters.SchemeNameHindi', 'tbl_transactiondetails.PRN', 'tbl_transactiondetails.SchemeId', 'tbl_transactiondetails.TransactionAmount', 'tbl_transactiondetails.RemitterName', 'tbl_transactiondetails.RemitterMobile', 'tbl_transactiondetails.created_at']);
        $dept = DB::table('tbl_schememasters')->get();
        $balance = DB::table('tbl_transactiondetails')->sum('TransactionAmount');
        $count = DB::table('tbl_departmentmasters')->count();
        $schemes = DB::table('tbl_schememasters')->count();
        $transaction = DB::table('tbl_transactiondetails')->count();

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
            ->with('success', 'New Dpartment Save successfully');
    }
    public function edit($DepartmentId)
    {      
        $user = tbl_departmentmetadata::firstOrNew(['DepartmentId' => $DepartmentId]); 
        // $user = tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->first();
        if(!$user){
            $user = new tbl_departmentmetadata();
        }
        return view('nice-html/updateDepartment', compact('user'))->with('success', 'Configration Updated successfully');
        // $user = tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->first();
        // return view('nice-html/updateDepartment', compact('user'));
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
       
        // $desc = tbl_departmentmetadata::updateOrCreate(
        //     ['DepartmentId' => $DepartmentId],
        //     [
        //         'Slug' => $request->input('Slug'),
        //         'Heading' => $request->input('Heading'),
        //         'ShortDescription' => $request->input('ShortDescription'),
        //         'LongDescription' => $request->input('LongDescription'),
        //     ]
        // );
        
        // if ($request->hasFile('Images')) {
        //     $destination = 'uploads/department/' . $desc->Images;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('Images');
        //     $extenstion = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extenstion;
        //     $file->move('uploads/department/', $filename);
        //     $desc->Images = $filename;
        //     $desc->save();
        // }
        
        // if ($DepartmentId) {
        //     return redirect()
        //         ->back()
        //         ->with('success', 'Department Updated successfully');
        // }
        
        // return redirect()
        //     ->back()
        //     ->with('success', 'Department Created successfully');
        
        // $desc = tbl_departmentmetadata::firstOrCreate(['DepartmentId' => $request->input('DepartmentId')]);

        // if (!$desc) {
        //     $desc = new tbl_departmentmetadata;
        // }
    
        // $desc->Slug = $request->input('Slug');
        // $desc->Heading = $request->input('Heading');
        // $desc->ShortDescription = $request->input('ShortDescription');
        // $desc->LongDescription = $request->input('LongDescription');
    
        // if ($request->hasFile('Images')) {
        //     $destination = 'uploads/department/' . $desc->Images;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('Images');
        //     $extenstion = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extenstion;
        //     $file->move('uploads/department/', $filename);
        //     $desc->Images = $filename;
        // }
    
        // $desc->save();
    
        // if (!$DepartmentId) {
        //     return redirect()
        //         ->back()
        //         ->with('success', 'Department created successfully');
        // }
    
        // return redirect()
        //     ->back()
        //     ->with('success', 'Department updated successfully');





        // $desc = tbl_departmentmetadata::findOrNew($DepartmentId);

        // $desc->Slug = $request->input('Slug');
        // $desc->Heading = $request->input('Heading');
        // $desc->ShortDescription = $request->input('ShortDescription');
        // $desc->LongDescription = $request->input('LongDescription');
    
        // if ($request->hasFile('Images')) {
        //     $destination = 'uploads/department/' . $desc->Images;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('Images');
        //     $extenstion = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extenstion;
        //     $file->move('uploads/department/', $filename);
        //     $desc->Images = $filename;
        // }    
   
        // $desc->save();                
        // $message = $DepartmentId ? 'Department updated successfully' : 'Department created successfully';
        
        // return redirect()->back()->with('success', $message); 
        

        // $desc = tbl_departmentmetadata::updateOrCreate(
        //     ['DepartmentId' => $DepartmentId],
        //     [
        //                'Slug' => $request->input('Slug'),
        //         'Heading' => $request->input('Heading'),
        //         'ShortDescription' => $request->input('ShortDescription'),
        //         'LongDescription' => $request->input('LongDescription'),
        //     ]
        // );
        //      if ($request->hasFile('Images')) {
        //     $destination = 'uploads/department/' . $desc->Images;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('Images');
        //     $extenstion = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extenstion;
        //     $file->move('uploads/department/', $filename);
        //     $desc->Images = $filename;
        // }    
        // return redirect()
        //     ->back()
        //     ->with('success', 'Department updated successfully');

        // 2NDMAIN 
        //    $data = [
        //         'Slug' => $request->input('Slug'),
        //         'Heading' => $request->input('Heading'),
        //         'ShortDescription' => $request->input('ShortDescription'),
        //         'LongDescription' => $request->input('LongDescription'),
        //     ];
        
        //     if ($request->hasFile('Images')) {
        //         $file = $request->file('Images');
        //         $extenstion = $file->getClientOriginalExtension();
        //         $filename = time() . '.' . $extenstion;
        //         $file->move('uploads/department/', $filename);
        //         $data['Images'] = $filename;
        //     }
        
        //     tbl_departmentmetadata::updateOrCreate(['DepartmentId' => $DepartmentId], $data);
        
        //     return redirect()
        //         ->back()
        //         ->with('success', 'Department updated successfully');
      
                
    // 1stmain    
        // $desc = tbl_departmentmetadata::find($DepartmentId);

        // $desc->Slug = $request->input('Slug');
        // $desc->Heading = $request->input('Heading');
        // $desc->ShortDescription = $request->input('ShortDescription');
        // $desc->LongDescription = $request->input('LongDescription');

        // if ($request->hasFile('Images')) {
        //     $destination = 'uploads/department/' . $desc->Images;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('Images');
        //     $extenstion = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extenstion;
        //     $file->move('uploads/department/', $filename);
        //     $desc->Images = $filename;
        // }

        // $desc->update();
        // return redirect()
        //     ->back()
        //     ->with('success', 'Department Updated successfully');
       
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

    public function deptedit($DepartmentId)
    {
        $user = tbl_departmentmaster::where('DepartmentId', '=', $DepartmentId)->first();
        return view('nice-html/DeptEdit', compact('user'))->with('success', 'Department Updated successfully');
    }
    public function showdept()
    {
        $user = tbl_departmentmaster::all();
        return view('nice-html/departmentshow', compact('user'));
    }
    public function deptupdate(Request $request, $DepartmentId)
    {
        // dd($request->all());
        // $tbl_departmentmaster->update($request->all());

        $dept = tbl_departmentmaster::find($DepartmentId);
        $dept->DepartmentName = $request->input('DepartmentName');
        $dept->DepartmentNameHindi = $request->input('DepartmentNameHindi');
        $dept['IsActive'] = $request->has(key: 'IsActive');
        // $dept = $request->has('checkbox') ? $request->input('checkbox') : false
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
            ->get(['tbl_schememasters.*', 'tbl_departmentmasters.DepartmentName'])
            ->where('SchemeId', '=', $SchemeId)
            ->first();
        // $user = tbl_schememaster::where('SchemeId', '=', $SchemeId)->first();
        return view('nice-html/SchemeEdit', compact('user'))->with('success', 'Scheme Updated successfully');
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
        return view('nice-html/ssoEdit', compact('user','roles'))->with('success', 'user SSO Updated successfully');
    }
    public function ssoupdate(Request $request, $id)
    {       
        $scheme = tbl_usermaster::findOrFail($request->id);
        $scheme['IsActive'] = $request->has(key: 'IsActive');
        $scheme->update($request->all());
        return redirect()
            ->back()
            ->with('success', 'User SSO Update Successfully');
    }   
}
