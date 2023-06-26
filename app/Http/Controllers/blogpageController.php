<?php

namespace App\Http\Controllers;

use App\Models\tbl_departmentmaster;
use App\Models\tbl_departmentmetadata;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class blogpageController extends Controller
{
    public function index($slug)
    {
        try {
            $users = tbl_departmentmetadata::where('slug', $slug)->firstOrFail();
            $departmentId = $users->DepartmentId;
            $department = tbl_departmentmaster::findOrFail($departmentId);
            return view('website/blogpage', compact('department', 'users', 'slug'));
        } catch (ModelNotFoundException  $e) {
            // Log the exception for debugging purposes
            Log::error('Error retrieving department or department metadata from the database: ' . $e->getMessage());
   
            // Return an error response or redirect the user to an error page
            return view('website/invalid_page');// Replace 'error-page' with your actual error page view
        }
    }
}
