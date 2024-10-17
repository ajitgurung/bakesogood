<?php

use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\MessageController;
use App\Http\Controllers\Frontend\ViewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderPdfController;


Route::get('/', function () {
    return view('frontend.welcome');
})->name('home');

Route::get('/shop/{slug}', function () {
    return view('frontend.shop', compact('slug'));
})->name('shop');

Route::get('/product/{product_slug}', [ViewController::class, 'product'])->name('product');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::post('/message', [MessageController::class, 'store'])->name('message.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CartController::class)->group(function(){
    Route::get('/cart', 'showCart')->name('cart');
    Route::post('/cart/store', 'addToCart')->name('cart.add');
    Route::post('/cart/update', 'updateCart')->name('cart.update');
    Route::get('/cart/remove/{slug}', 'remove')->name('cart.remove');
});

Route::controller(CheckoutController::class)->group(function(){
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::get('/get-states/{code}', 'getStates')->name('getStates');
    Route::post('/place-order', 'placeOrder')->name('checkout.placeorder');
    Route::view('/checkout/success', 'checkout.success')->name('checkout-success');
});

Route::post('/order/create', [OrderController::class, 'store'])->name('orders.custom.create');

Route::middleware('signed')
    ->get('orders/{order}/pdf', OrderPdfController::class)
    ->name('order.pdf');

require __DIR__.'/auth.php';
