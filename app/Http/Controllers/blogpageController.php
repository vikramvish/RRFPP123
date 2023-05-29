<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_departmentmetadata;

class blogpageController extends Controller
{
    public function index($slug)
    {
        $users = tbl_departmentmetadata::where('slug', $slug)->first();         
        return view('website/blogpage', compact('users'));
    }
}
