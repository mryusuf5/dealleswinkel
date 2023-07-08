<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductimagesController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductcategoriesController;
use App\Http\Controllers\ProductsController;

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

Route::get('/', [ProductcategoriesController::class, 'userIndex'])->name('home');

Route::get('/login', [UserController::class, 'loginView'])->name('loginView');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('/categories')->name('productcategories.')->group(function(){
    Route::get('', [ProductcategoriesController::class, 'userCategories'])->name('index');
    Route::get('/{id}', [ProductcategoriesController::class, 'userSingleCategory'])->name('show');
});

Route::get('/products/{id}', [ProductsController::class, 'show'])->name('userSingleProduct');

Route::prefix('/cart')->name('carts.')->group(function(){
    Route::get('', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'store'])->name('add');
    Route::delete('/delete/{index}', [CartController::class, 'destroy'])->name('destroy');
});

Route::prefix('/checkout')->name('checkout.')->group(function(){
    Route::get('', [CheckoutController::class, 'index'])->name('index');
});

Route::resource('reviews', ReviewsController::class);
Route::post('/orders/add', [OrdersController::class, 'store'])->name('orders.store');

Route::prefix('/admin')->name('admin.')->middleware('IsAdmin')->group(function(){
    Route::get('', [UserController::class, "index"])->name('dashboard');

    Route::resource('productcategories', ProductcategoriesController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource("productimages", ProductimagesController::class);
});


