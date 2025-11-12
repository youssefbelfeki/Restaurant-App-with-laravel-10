<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'foodDetails'])->name('foodDetails');

//Cart route
Route::post('foods/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('foodCart');
Route::get('foods/cart', [App\Http\Controllers\Foods\FoodsController::class, 'displayCart'])->name('displayCart');
Route::get('foods/cart/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'deleteItem'])->name('deleteItem');

//checkout route
Route::post('foods/prepare_checkout', [App\Http\Controllers\Foods\FoodsController::class, 'prepareCheckout'])->name('prepare_checkout');

//insert user info
Route::get('foods/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'checkout'])->name('checkout');
Route::post('foods/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'storeCheckout'])->name('prepare_checkout-store');

//payment with paypal 
Route::get('foods/pay', [App\Http\Controllers\Foods\FoodsController::class, 'payWithPaypal'])->name('payWithPaypal');
Route::get('foods/success', [App\Http\Controllers\Foods\FoodsController::class, 'success'])->name('success');

//booking table
Route::post('foods/booking', [App\Http\Controllers\Foods\FoodsController::class, 'bookingTables'])->name('bookingTables');