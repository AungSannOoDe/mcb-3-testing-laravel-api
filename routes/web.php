<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FactController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SourceAreaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

// --- Root / Role Selection ---
Route::get('/', function () {
    return view('userole');
})->name('index');

Route::get('/role', function() {
    return view('userole');
})->name('role.show');

Route::post('/role', function() {
    $role = request()->role;
    return ($role == 1) ? redirect()->route('user.login') : redirect()->route('admin.login');
})->name('role.submit');

// --- Standard Laravel Auth ---
Auth::routes();

// --- Custom Authentication ---
Route::get('/user/login', [LoginController::class, 'userLoginForm'])->name('user.login');
Route::get('/admin/login', [LoginController::class, 'adminLoginForm'])->name('admin.login');
Route::get('/user/register', [RegisterController::class, 'registerForm'])->name('user.register');

// --- Home ---
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// --- Orders ---
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/order/add', [OrderController::class, 'orderForm'])->name('orders.create');
Route::post('/order/add', [OrderController::class, 'create'])->name('orders.store');
Route::get('/user/{id}/orders', [OrderController::class, 'show'])->name('user.orders.show');
Route::get('orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
Route::post('/orders/update/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::post('/orders/export', [OrderController::class, 'exportAll'])->name('orders.export');

// --- Products & Categories ---
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/category/add', [CategoryController::class, 'store'])->name('category.store');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'findByCategoryId'])->name('products.category');
Route::post('/product/add', [ProductController::class, 'store'])->name('product.store');

// --- Infrastructure ---
Route::get('/sourceareas', [SourceAreaController::class, 'index'])->name('sourceareas.index');
Route::post('/sourceArea/add', [SourceAreaController::class, 'store'])->name('sourceArea.store');
Route::get('/gates', [GateController::class, 'index'])->name('gates.index');
Route::post('/gate/add', [GateController::class, 'store'])->name('gate.store');
Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::post('/shop/add', [ShopController::class, 'store'])->name('shop.store');

// --- Facts ---
Route::get('/facts/add', [FactController::class, 'showFactForms'])->name('facts.create');
Route::post('/facts/update/{id}', [FactController::class, 'edit'])->name('facts.update');
Route::delete('/facts/delete/{id}', [FactController::class, 'delete'])->name('facts.delete');

// --- USER & PASSWORD (FIXED CONFLICTS HERE) ---
Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change.show');
Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change.update');

Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('user.forgot-password.show');
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('user.forgot-password.submit');

Route::get('/reset-password', [UserController::class, 'showResetPasswordForm'])->name('user.reset-password.show');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password.submit');