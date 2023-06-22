<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login & logout routes
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

// route landing page dan dashboard
Route::get('/', [HomeController::class, 'index'])->middleware('guest');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop')->middleware('auth');
Route::post('/shop/search', [HomeController::class, 'search'])->name('shop.search')->middleware('auth');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'must-admin-or-manager']);
Route::get('/faq', [HomeController::class, 'faq'])->middleware(['auth', 'must-admin-staff-manager']);
Route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware(['auth', 'must-admin-staff-manager']);
Route::put('/profile/{id}', [HomeController::class, 'profile_update'])->name('update_profile')->middleware(['auth', 'must-admin-staff-manager']);
Route::put('/password/{id}', [HomeController::class, 'change_password'])->name('change_password')->middleware(['auth', 'must-admin-staff-manager']);

// resource controllers
Route::middleware(['auth', 'must-admin-or-staff'])->group(function () {
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'sliders' => SliderController::class,
    ]);

    // sliders index & show
    Route::get('/sliders', [SliderController::class, 'index'])
        ->name('sliders.index')
        ->withoutMiddleware('must-admin-or-staff')
        ->middleware('must-admin-staff-manager');

    Route::get('/sliders/{slider}', [SliderController::class, 'show'])
        ->name('sliders.show')
        ->withoutMiddleware('must-admin-or-staff')
        ->middleware('must-admin-staff-manager');

    // categories index
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index')
        ->withoutMiddleware('must-admin-or-staff')
        ->middleware('must-admin-staff-manager');

    // products index & show
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index')
        ->withoutMiddleware('must-admin-or-staff')
        ->middleware('must-admin-staff-manager');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show')
        ->withoutMiddleware('must-admin-or-staff')
        ->middleware('must-admin-staff-manager');
});

Route::middleware(['auth', 'must-admin'])->group(function () {
    Route::resources([
        'users' => UserController::class,
        'usergroups' => UserGroupController::class,
    ]);
});

// activate dan deactivate
Route::middleware(['auth', 'must-manager'])->group(function () {
    Route::get('/sliders/activate/{id}', [SliderController::class, 'activate'])
        ->name('sliders.activate');
    Route::get('/sliders/deactivate/{id}', [SliderController::class, 'deactivate'])
        ->name('sliders.deactivate');
    Route::get('/products/accept/{id}', [ProductController::class, 'accept'])
        ->name('products.accept');
    Route::get('/products/reject/{id}', [ProductController::class, 'reject'])
        ->name('products.reject');
});

// redirect
Route::redirect('/home', '/dashboard')->middleware('auth');

// ketika route tidak ditemukan
Route::fallback(function () {
    return view('pages-error-404');
});
