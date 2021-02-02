<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\OrderController;

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



Route::get('/', function () {
    return view('auth.index');
});
Route::get('/blog', function () {
    return view('auth.blog');
});
Route::get('/shop', function () {
    return view('auth.shop');
});
Route::get('/contact', function () {
    return view('auth.contact');
});
Route::get('/checkout', function () {
    return view('auth.checkout');
});
Route::get('/product_detail', function () {
    return view('auth.product_detail');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/single-product/{id}', [DesignController::class, 'singleProduct'])->name('single.product');
Route::get('/single-products/{id}', [DesignController::class, 'singleCategoryProduct'])->name('single.category.product');
Route::get('/brand-products/{id}', [DesignController::class, 'getProductByBrand'])->name('getProductByBrand');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/orders', [OrderController::class, 'index'])->name('user.order.index');
Route::post('/placeOrder', [OrderController::class, 'placedOrder'])->name('checkout.place.order');
Route::get('/orderDetails/{id}', [OrderController::class, 'orderDetails'])->name('order.details');
Route::get('/placedOrder', [OrderController::class, 'placedOrderDetails'])->name('user.placedOrder');
// Payment Route
Route::post('/payment/{id}', [OrderController::class, 'payment'])->name('pay');
Route::post('/success', [OrderController::class, 'paymentSuccess'])->name('success');
Route::get('/placedOrder', [OrderController::class, 'placedOrderDetails'])->name('user.placedOrder');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/sub-categories', SubCategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::get('get-brandSubCategory-list', [BrandController::class, 'brandSubCategory']);
    Route::get('get-childSubCategory-list', [BrandController::class, 'childSubCategory']);
    Route::resource('/product', ProductController::class);
    Route::get('get-subcategory-list', [ProductController::class, 'getSubCategoryList']);
    Route::get('get-parentSubCategory-list', [ProductController::class, 'parentSubCategory']);
});