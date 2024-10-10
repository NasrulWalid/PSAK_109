<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingControllerAdmin extends Controller
{
    /**
     * Show the price view.
     *
     * @return \Illuminate\View\View
     */
    public function showadmin()
    {
        return view('admin.pricing.price');
    }
    
}