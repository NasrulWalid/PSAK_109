<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Show the price view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('pricing.price');
    }
    public function showsuperadmin()
    {
        return view('superadmin.pricing.price');
    }
}