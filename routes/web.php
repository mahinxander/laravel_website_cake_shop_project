<?php

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

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginProcess'])->middleware('guest')->name('login');
Route::get('/welcome', [App\Http\Controllers\Auth\LoginController::class, 'showDash'])->name('dashboard');
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showDash'])->name('dashboard2');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginPage'])->middleware('guest')->name('loginClick');
Route::get('/register', [App\Http\Controllers\Auth\LoginController::class, 'registerPage'])->middleware('guest')->name('registerClick');
Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'registerProcess'])->middleware('guest')->name('register');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/activate/{token}', [App\Http\Controllers\Auth\LoginController::class, 'activate'])->name('activate');
Route::get('/about-us', [App\Http\Controllers\Auth\LoginController::class, 'aboutus'])->name('aboutus');

//category=========================================================================================================================================================
Route::get('/categories',[App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/add',[App\Http\Controllers\CategoryController::class, 'create'])->middleware('auth','isAdmin')->name('categories.create');
Route::post('/categories',[App\Http\Controllers\CategoryController::class, 'store'])->middleware('auth','isAdmin')->name('categories.store');
Route::get('/categories/{id}',[App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/edit',[App\Http\Controllers\CategoryController::class, 'edit'])->middleware('auth','isAdmin')->name('categories.edit');
Route::put('/categories/{id}',[App\Http\Controllers\CategoryController::class, 'update'])->middleware('auth','isAdmin')->name('categories.update');
Route::delete('/categories/{id}',[App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('auth','isAdmin')->name('categories.destroy');


//products=============================================================================================================================================================
Route::get('/products',[App\Http\Controllers\ProductController::class, 'index'])->middleware('auth','isAdmin')->name('products.index');
Route::get('/shop',[App\Http\Controllers\ProductController::class, 'productShop'])->name('products.productshop');
Route::get('/products/add',[App\Http\Controllers\ProductController::class, 'create'])->middleware('auth','isAdmin')->name('products.create');
Route::post('/products',[App\Http\Controllers\ProductController::class, 'store'])->middleware('auth','isAdmin')->name('products.store');
Route::get('/products/{id}',[App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit',[App\Http\Controllers\ProductController::class, 'edit'])->middleware('auth','isAdmin')->name('products.edit');
Route::put('/products/{id}',[App\Http\Controllers\ProductController::class, 'update'])->middleware('auth','isAdmin')->name('products.update');
Route::delete('/products/{id}',[App\Http\Controllers\ProductController::class, 'destroy'])->middleware('auth','isAdmin')->name('products.destroy');


//cart==============================================================================================================================================================
Route::get('/cart', [App\Http\Controllers\Cart\CartController::class, 'show'])->middleware('auth')->name('cart.show');
Route::post('/cart/buynow', [App\Http\Controllers\Cart\CartController::class, 'buynow'])->middleware('auth')->name('cart.buynow');
Route::get('/cart/remove', [App\Http\Controllers\Cart\CartController::class, 'update'])->middleware('auth')->name('cart.remove');
Route::get('/checkout', [App\Http\Controllers\Cart\CartController::class, 'checkout'])->middleware('auth')->name('cart.checkout');
Route::post('/cart', [App\Http\Controllers\Cart\CartController::class, 'addToCart'])->middleware('auth')->name('cart.addToCart');


//order===============================================================================================================================================================
Route::post('/order', [App\Http\Controllers\Cart\CartController::class, 'processOrder'])->middleware('auth')->name('order');
Route::get('/order/history',[App\Http\Controllers\Order\OrderController::class, 'index'])->middleware('auth','isAdmin')->name('orders.index');
Route::delete('/order/{id}',[App\Http\Controllers\Order\OrderController::class, 'destroy'])->middleware('auth','isAdmin')->name('orders.destroy');
