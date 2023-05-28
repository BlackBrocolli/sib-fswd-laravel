<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserGroupController;
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

// route landing page
Route::get('/', [HomeController::class, 'index']);

// route resource crud users
Route::resource('/users', UserController::class);

// route dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard']);

// ketika route tidak ditemukan
Route::fallback(function () {
    return view('pages-error-404');
});

// route resource curd categories
Route::resource('/categories', CategoryController::class);

// route resource crud products
Route::resource('/products', ProductController::class);

// route resource crud user_groups
Route::resource('/usergroups', UserGroupController::class);

// route resource crud sliders
Route::resource('/sliders', SliderController::class);
