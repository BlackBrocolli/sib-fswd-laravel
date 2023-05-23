<?php

/**
 * Controller ini untuk mengatur landing page
 * dan mengatur halaman utama pada dashboard
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        //get users
        $sliders = Slider::latest()->get();

        return view('landing', compact('sliders'));
    }
}
