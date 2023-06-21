<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/product/{slug}', 'product')->name('product');
    Route::get('/category/{slug}', 'category')->name('category');
});

Route::middleware('auth', 'verified', 'role:user')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/wishlist', 'wishlist')->name('wishlist');
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/cart', 'cartadd')->name('cart.add');
        Route::delete('/cart', 'cartdelete')->name('cart.delete');
        Route::get('/checkout', 'checkout')->name('checkout');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/orderpending', 'orderpending')->name('orderpending');
        Route::get('/history', 'history')->name('history');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/category', 'index')->name('admin.category');
        Route::get('/admin/category/create', 'create')->name('admin.category.create');
        Route::get('/admin/category/edit/{id}', 'edit')->name('admin.category.edit');
        Route::post('/admin/category/store', 'store')->name('admin.category.store');
        Route::put('/admin/category/update/{id}', 'update')->name('admin.category.update');
        Route::delete('/admin/category/delete/{id}', 'delete')->name('admin.category.delete');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/subcategory', 'index')->name('admin.subcategory');
        Route::get('/admin/subcategory/create', 'create')->name('admin.subcategory.create');
        Route::get('/admin/subcategory/edit/{id}', 'edit')->name('admin.subcategory.edit');
        Route::post('/admin/subcategory/store', 'store')->name('admin.subcategory.store');
        Route::put('/admin/subcategory/update/{id}', 'update')->name('admin.subcategory.update');
        Route::delete('/admin/subcategory/delete/{id}', 'delete')->name('admin.subcategory.delete');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/product', 'index')->name('admin.product');
        Route::get('/admin/product/create', 'create')->name('admin.product.create');
        Route::get('/admin/product/edit/{id}', 'edit')->name('admin.product.edit');
        Route::post('/admin/product/store', 'store')->name('admin.product.store');
        Route::put('/admin/product/update/{id}', 'update')->name('admin.product.update');
        Route::put('/admin/product/updateimage/{id}', 'updateimage')->name('admin.product.updateimage');
        Route::delete('/admin/product/delete/{id}', 'delete')->name('admin.product.delete');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/orderpending', 'pending')->name('admin.order.pending');
        Route::get('/admin/ordersuccess', 'success')->name('admin.order.success');
    });
});

require __DIR__.'/auth.php';
