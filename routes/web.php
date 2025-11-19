<?php

use App\Http\Controllers\Foods\FoodsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminController;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'service'])->name('service');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::group(["prefix" => "foods"], function () {
    //food details route
    Route::get('/food-details/{id}', [FoodsController::class, 'foodDetails'])->name('foodDetails');

    //Cart route
    Route::post('/food-details/{id}', [FoodsController::class, 'cart'])->name('foodCart');
    Route::get('/cart', [FoodsController::class, 'displayCart'])->name('displayCart');
    Route::get('/cart/{id}', [FoodsController::class, 'deleteItem'])->name('deleteItem');

    //checkout route
    Route::post('/prepare_checkout', [FoodsController::class, 'prepareCheckout'])->name('prepare_checkout');

    //insert user info route
    Route::get('/checkout', [FoodsController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [FoodsController::class, 'storeCheckout'])->name('prepare_checkout-store');

    //payment with paypal route
    Route::get('/pay', [FoodsController::class, 'payWithPaypal'])->name('payWithPaypal');
    Route::get('/success', [FoodsController::class, 'success'])->name('success');

    //booking route
    Route::post('/booking', [FoodsController::class, 'bookingTables'])->name('bookingTables');

    //menu route
    Route::get('foods/menu', [FoodsController::class, 'foodMenu'])->name('foodMenu');
});

Route::group(["prefix" => "users"], function () {
    //menu route
    Route::get('/all-bookings', [UsersController::class, 'getBooking'])->name('getBooking');
    Route::get('/all-orders', [UsersController::class, 'getOrders'])->name('getOrders');
    //review route
    Route::get('/review', [UsersController::class, 'viewReview'])->name('viewReview');
    Route::post('/review', [UsersController::class, 'storeReview'])->name('storeReview');
});

Route::get('admin/login', [AdminController::class, 'viewLogin'])->name('viewLogin')->middleware('checkForAuth');
Route::post('admin/login', [AdminController::class, 'checkLogin'])->name('checkLogin');

Route::group(["prefix" => "admin", "middleware" => "auth:admin"], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //admins
    Route::get('all-admins', [AdminController::class, 'allAdmin'])->name('allAdmin');
    Route::get('new-admins', [AdminController::class, 'newAdmin'])->name('newAdmin');
    Route::post('/new-admins', [AdminController::class, 'createNewAdmin'])->name('createNewAdmin');

    //orders
    Route::get('all-orders', [AdminController::class, 'allOrders'])->name('allOrders');
    Route::get('edit-orders/{id}', [AdminController::class, 'EditOrder'])->name('EditOrder');
    Route::post('edit-orders/{id}', [AdminController::class, 'UpdateOrder'])->name('UpdateOrder');
    Route::get('delete-orders/{id}', [AdminController::class, 'DeleteOrder'])->name('DeleteOrder');

    //booking
    Route::get('all-booking', [AdminController::class, 'allBooking'])->name('allBooking');

    //foods
    Route::get('all-foods', [AdminController::class, 'allFoods'])->name('allFoods');
    Route::get('create-food', [AdminController::class, 'createFood'])->name('createFood');
    Route::post('create-food', [AdminController::class, 'storeFood'])->name('storeFood');
    Route::get('delete-food/{id}', [AdminController::class, 'DeleteFood'])->name('deleteFood');
});
