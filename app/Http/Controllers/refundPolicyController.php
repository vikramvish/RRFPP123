<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class refundPolicyController extends Controller
{
    public function refundpolicy()
    {
        return view("website/refundpolicy");
    }
    public function TermsCondition()
    {
        return view("website/TermsCondition");
    }
    public function PrivacyPolicy()
    {
        return view("website/PrivacyPolicy");
    }
    public function CancellationPolicy()
    {
        return view("website/CancellationPolicy");
    }
    public function ChargebackGuidelines()
    {
        return view("website/ChargebackGuidelines");
    }
}
