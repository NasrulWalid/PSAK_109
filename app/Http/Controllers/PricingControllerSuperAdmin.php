<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingControllerSuperAdmin extends Controller
{
    /**
     * Show the price view.
     *
     * @return \Illuminate\View\View
     */
    public function showsuperadmin()
    {
        return view('superadmin.pricing.price');
    }
}