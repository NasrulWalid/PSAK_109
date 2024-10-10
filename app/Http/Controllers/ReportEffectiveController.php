<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportEffectiveController extends Controller
{
    public function showreportamortisedcost()
    {
    
        return view('admin.reporteffective.reportamortisedcost');
    }
}
