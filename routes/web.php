<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [ProductsController::class, 'store']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');

Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');
Route::delete('/coupon', [CouponController::class, 'destroy'])->name('coupon.destroy');

