<?php

/**
 * Controller ini untuk mengatur landing page
 * dan mengatur halaman utama pada dashboard
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\ViewProduct;

class HomeController extends Controller
{
    public function index()
    {
        //get sliders and products
        $sliders = Slider::latest()->get();
        $products = ViewProduct::take(9)->get();

        return view('landing', compact('sliders', 'products'));
    }
}
