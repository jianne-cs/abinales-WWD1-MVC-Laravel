<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', function () {
    return redirect('/dashboard');
})->name('homepage');

// Add to Cart Page - Public Access
Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/clear', [ProductController::class, 'clearCart'])->name('cart.clear');

// MIKU EXPO Store - Public Access
Route::get('/store', [ProductController::class, 'index'])->name('store');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Authentication Routes (Provided by Laravel UI)
Auth::routes(['register' => false]); // Disable registration for security

// Protected Admin Routes - Require Authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Customer Management
    Route::resource('customers', CustomerController::class);
    
    // Product Management (Full CRUD)
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    
    // Order Management
    Route::resource('orders', OrderController::class);
    
    // Cart Routes
    Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/remove', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [ProductController::class, 'updateCart'])->name('cart.update');
});

// Fallback Route
Route::fallback(function () {
    return redirect()->route('homepage');
});