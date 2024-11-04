<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Grup route untuk Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('admin/produk', [AdminController::class, 'produk'])->name('admin.produk.index');
        Route::get('admin/produk/create', [AdminController::class, 'create_produk'])->name('admin.produk.create');
        Route::post('produk/store', [AdminController::class, 'store_produk'])->name('admin.produk.store');
        Route::get('admin/produk/{product}/edit', [AdminController::class, 'edit_produk'])->name('admin.produk.edit');
        Route::put('admin/produk/{product}', [AdminController::class, 'update_produk'])->name('admin.produk.update');
        Route::delete('admin/produk/{product}/delete', [AdminController::class, 'delete_produk'])->name('admin.produk.delete');
        Route::post('admin/produk/{product}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.produk.toggleStatus');


    });

    // Grup route untuk Customer
    Route::middleware('role:customer')->group(function () {
        Route::get('customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
        Route::get('/cart', [CustomerController::class, 'cart'])->name('cart');
        Route::post('/cart/add/{id}', [CustomerController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{id}', [CustomerController::class, 'remove'])->name('cart.remove');
        Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
        Route::post('/payment/{order}', [PaymentController::class, 'createPayment']);
        Route::post('/payment/notification', [PaymentController::class, 'notification']);

    });
});