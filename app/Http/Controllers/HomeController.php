<?php

/**
 * Controller ini untuk mengatur landing page
 * dan mengatur halaman utama pada dashboard
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\ViewProduct;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Get active sliders and accepted products
        $sliders = Slider::where('is_active', 1)->latest()->get();
        $products = Product::where('status', 'accepted')->take(9)->get();
        $categories = Category::orderBy('name')->get();

        return view('landing', compact('sliders', 'products', 'categories'));
    }

    public function dashboard()
    {
        $navitem = 'dashboard';
        $navitemchild = '';

        return view('dashboard', compact('navitem', 'navitemchild'));
    }

    public function shop()
    {
        $products = Product::where('status', 'accepted')->get();
        $categories = Category::orderBy('name')->get();

        return view('shop.shop', compact('products', 'categories'));
    }

    public function search(Request $request)
    {
        if ($request->has('submit_price')) {
            // Tombol submit_price ditekan
            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price');

            if (!empty($minPrice) && !empty($maxPrice)) {
                // Lakukan pencarian dengan rentang harga
                $products = Product::whereBetween('price', [$minPrice, $maxPrice])
                    ->where('status', 'accepted')
                    ->get();

                $categories = Category::orderBy('name')->get();
                $searching = true;

                return view('shop.shop', compact('products', 'categories', 'searching'));
            } elseif (!empty($minPrice)) {
                // Lakukan pencarian dengan min_price dan max_price tidak terbatas
                $products = Product::where('price', '>=', $minPrice)
                    ->where('status', 'accepted')
                    ->get();

                $categories = Category::orderBy('name')->get();
                $searching = true;

                return view('shop.shop', compact('products', 'categories', 'searching'));
            } elseif (!empty($maxPrice)) {
                // Lakukan pencarian dengan max_price dan min_price 0
                $products = Product::where('price', '<=', $maxPrice)
                    ->where('status', 'accepted')
                    ->get();

                $categories = Category::orderBy('name')->get();
                $searching = true;

                return view('shop.shop', compact('products', 'categories', 'searching'));
            }
        } else {
            $searchQuery = $request->input('search');
            $products = Product::where('name', 'LIKE', "%$searchQuery%")
                ->where('status', 'accepted')
                ->get();

            $categories = Category::orderBy('name')->get();
            $searching = true;

            return view('shop.shop', compact('products', 'categories', 'searching'));
        }

        // Kode berikut akan dijalankan jika input min_price dan max_price kosong
        $products = Product::where('status', 'accepted')->get();
        $categories = Category::orderBy('name')->get();

        return view('shop.shop', compact('categories', 'products'));
    }

    public function faq()
    {
        $navitem = 'faq';
        $navitemchild = '';

        return view('faq.index', compact('navitem', 'navitemchild'));
    }
}
