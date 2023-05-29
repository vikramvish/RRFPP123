<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_departmentmetadata;
use App\Models\tbl_departmentmaster;
use App\Models\tbl_schememaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('nice-html/Department');
    }

    public function departmentdata()
    {
        $user = tbl_departmentmetadata::all();
        return view('nice-html/Department', ['user' => $user]);
    }

    public function editable()
    {
        return view('nice-html/DepartmentAdd');
    }

    public function addnew(Request $request)
    {
        $desc = new tbl_departmentmetadata();
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
        $user = tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->first();
        return view('nice-html/DepartmentEdit', compact('user'));
    }

    public function savenew(Request $request, $DepartmentId)
    {
        $desc = tbl_departmentmetadata::find($DepartmentId);

        $desc->ShortDescription = $request->input('ShortDescription');
        $desc->LongDescription = $request->input('LongDescription');

        if ($request->hasFile('Images')) {
            $destination = 'uploads/department/' . $desc->Images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('Images');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move('uploads/department/', $filename);
            $desc->Images = $filename;
        }

        $desc->update();
        return redirect()
            ->back()
            ->with('success', 'Department Updated successfully');
    }

    public function delete($DepartmentId)
    {
        tbl_departmentmetadata::where('DepartmentId', '=', $DepartmentId)->delete();
        return redirect()
            ->back()
            ->with('success', 'You Have Deleted successfully');
    }
    public function newdept()
    {
        return view('nice-html/NewDepartment');
    }
    public function register(Request $request)
    {
        $dept = new tbl_departmentmaster();

        $dept->DepartmentName = request('DepartmentName');
        $dept->DepartmentNameHindi = request('DepartmentNameHindi');
        $dept->save();

        return Redirect::back()->with('success', 'Department Added successfully!');
    }

    public function newscm()
    {
        $department = DB::table('tbl_departmentmasters')->get();
        return view('nice-html/NewScheme', compact('department'));
    }
    public function insert(Request $request)
    {
        $dept = new tbl_schememaster();
        $dept->SchemeName = request('SchemeName');
        $dept->SchemeNameHindi = request('SchemeNameHindi');
        $dept->DepartmentId = request('department');
        $dept->save();

        return Redirect::back()->with('success', 'Scheme Added successfully!');
    }
}
