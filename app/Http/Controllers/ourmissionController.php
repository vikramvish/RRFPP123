<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ourmissionController extends Controller
{
    public function index()
    {
        return view("website/Ourmission");
    }
}
