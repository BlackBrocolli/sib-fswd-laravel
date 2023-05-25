<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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
