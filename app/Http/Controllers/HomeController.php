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
use App\Models\User;
use App\Models\User_group;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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

        $activeSlidersCount = Slider::where('is_active', 1)->count();
        $totalSlidersCount = Slider::count();

        $totalProductsCount = Product::count();
        $acceptedProductsCount = Product::where('status', 'accepted')->count();

        $waitingProducts = Product::where('status', 'waiting')->get();

        return view('dashboard', compact('navitem', 'navitemchild', 'waitingProducts', 'activeSlidersCount', 'totalSlidersCount', 'totalProductsCount', 'acceptedProductsCount'));
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

    public function profile()
    {
        $navitem = 'profile';
        $navitemchild = '';
        $usergroups = User_group::orderBy('id')->get();
        $active_tab = 'overview';
        $user = User::findOrFail(auth()->user()->id);

        return view('profile.index', compact('navitem', 'navitemchild', 'usergroups', 'active_tab', 'user'));
    }

    public function profile_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {

            /* //upload new avatar
            $image = $request->file('avatar');
            $avatarName = $image->hashName();
            $image->storeAs('public/images', $avatarName);

            // jika avatar bukan avatar default
            //delete old avatar
            if ($user->avatar != null && $user->avatar != "images/avatar_man.jpg") {
                Storage::delete('public/' . $user->avatar);
            } */

            //upload image
            $image = $request->file('avatar');
            $avatarName = $image->hashName();

            $imagePath = 'assets-dashboard/img/avatar/' . $avatarName;
            Image::make($image)
                ->save(public_path($imagePath));

            if ($user->avatar != 'default-avatar3.jpg') {
                //delete old avatar
                $oldImagePath = public_path('assets-dashboard/img/avatar/' . $user->avatar);
                File::delete($oldImagePath);
            }

            //update user with new avatar
            $user->update([
                'avatar' => $avatarName,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            //update user without avatar
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        // redirect to index
        /* return redirect()->route('profile')->with([
            'success' => "Profile data has been successfully updated!"
        ]); */

        $navitem = 'profile';
        $navitemchild = '';
        $usergroups = User_group::orderBy('id')->get();
        $active_tab = 'edit_profile';
        $user = User::findOrFail(auth()->user()->id);

        return view('profile.index', compact('navitem', 'navitemchild', 'usergroups', 'active_tab', 'user'))->with(['success_update_profile' => "Profile data has been successfully updated!"]);
    }

    public function change_password(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $navitem = 'profile';
        $navitemchild = '';
        $usergroups = User_group::orderBy('id')->get();
        $active_tab = 'change_password';

        $currentPasswordStatus = Hash::check($request->currentPassword, auth()->user()->password);
        if ($currentPasswordStatus) {
            if ($request->newPassword == $request->renewPassword) {

                $user->update([
                    'password' => Hash::make($request->newPassword),
                ]);

                // return redirect()->back()->with(['success' => "Password has been successfully updated!"]);
                return view('profile.index', compact('navitem', 'navitemchild', 'usergroups', 'active_tab', 'user'))->with(['success_change_password' => "Password has been successfully updated!"]);
            } else {
                // return redirect()->back()->with(['error' => "New password does not match with Re-enter password!"]);
                return view('profile.index', compact('navitem', 'navitemchild', 'usergroups', 'active_tab', 'user'))->with(['error_change_password' => "New password does not match with Re-enter password!"]);
            }
        } else {
            // return redirect()->back()->with(['error' => "Current password does not match with old password!"]);
            return view('profile.index', compact('navitem', 'navitemchild', 'usergroups', 'active_tab', 'user'))->with(['error_change_password' => "Current password does not match with old password!"]);
        }
    }
}
