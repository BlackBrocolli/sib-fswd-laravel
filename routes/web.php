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
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'must-admin-or-staff']);

// resource controllers
Route::middleware(['auth', 'must-admin'])->group(function () {
    Route::resources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'usergroups' => UserGroupController::class,
        'sliders' => SliderController::class,
    ]);

    // sliders index & show
    Route::get('/sliders', [SliderController::class, 'index'])
        ->name('sliders.index')
        ->withoutMiddleware('must-admin')
        ->middleware('must-admin-or-staff');

    Route::get('/sliders/{slider}', [SliderController::class, 'show'])
        ->name('sliders.show')
        ->withoutMiddleware('must-admin')
        ->middleware('must-admin-or-staff');

    // categories index
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index')
        ->withoutMiddleware('must-admin')
        ->middleware('must-admin-or-staff');

    // products index & show
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index')
        ->withoutMiddleware('must-admin');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show')
        ->withoutMiddleware('must-admin');

    // usergroups index
    Route::get('/usergroups', [UserGroupController::class, 'index'])
        ->name('usergroups.index')
        ->withoutMiddleware('must-admin')
        ->middleware('must-admin-or-staff');

    // users index & show
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->withoutMiddleware('must-admin')
        ->middleware('must-admin-or-staff');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->withoutMiddleware('must-admin')
        ->middleware('must-admin-or-staff');
});

// redirect
Route::redirect('/home', '/dashboard')->middleware('auth');

// ketika route tidak ditemukan
Route::fallback(function () {
    return view('pages-error-404');
});
