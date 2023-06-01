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
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth');

// resource controllers
Route::middleware('auth')->group(function () {
    Route::resources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'usergroups' => UserGroupController::class,
        'sliders' => SliderController::class,
    ]);
});

// redirect
Route::redirect('/home', '/dashboard')->middleware('auth');

// ketika route tidak ditemukan
Route::fallback(function () {
    return view('pages-error-404');
});
