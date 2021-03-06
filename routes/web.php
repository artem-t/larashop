<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', "App\Http\Controllers\AdminController@admin")->name('admin');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
//    Route::get('/products', [AdminController::class, 'products'])->name('adminProducts');
//    Route::get('/categories', [AdminController::class, 'categories'])->name('adminCategories');
    Route::resource('/categories', 'App\Http\Controllers\Admin\CategoryController');
    Route::resource('/products', 'App\Http\Controllers\Admin\ProductController');
    Route::get('/enterAsUser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    Route::post('/export-categories', [AdminController::class, 'exportCategories'])->name('exportCategories');
    Route::post('/export-products', [AdminController::class, 'exportProducts'])->name('exportProducts');
    Route::post('/import-categories', [AdminController::class, 'importCategories'])->name('importCategories');
    Route::prefix('roles')->group(function() {
        Route::post('/add', [AdminController::class, 'addRole'])->name('addRole');
        Route::post('/rmRole/{id}', [AdminController::class, 'rmRole'])->name('rmRole');
        Route::post('/addRoleToUser', [AdminController::class, 'addRoleToUser'])->name('addRoleToUser');
        Route::post('/rmRoleToUser', [AdminController::class, 'rmRoleToUser'])->name('rmRoleToUser');
    });
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'cart'])->name('cart');
    Route::post('/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/repeatToCart', [CartController::class, 'repeatToCart'])->name('repeatToCart');
    Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');
    Route::post('/cleanCart', [CartController::class, 'cleanCart'])->name('cleanCart');
});

Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/save', [ProfileController::class, 'save'])->name('saveProfile');

Auth::routes();
