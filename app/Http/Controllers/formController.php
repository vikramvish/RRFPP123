<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\form;

class formController extends Controller
{
    public function index()
    {
        $formData = Form::all(); // Retrieve the latest form data
        return view('form', compact('formData'));
      //  return view('form');
    }
    public function store(Request $request)
    {
        $form = new form;
        $form->fname = $request->fname;
        $form->save();
        return redirect('form');
    }
}
