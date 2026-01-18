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
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    //return view('welcome');
    return view('userole');
});

Auth::routes();

Route::get('/user/login', [LoginController::class, 'userLoginForm'])->name('user.login');
Route::get('/admin/login', [LoginController::class, 'adminLoginForm'])->name('admin.login');

Route::get('/role', function() {
    return view('userole');
});
Route::post('/role', function() {
    $role=request()->role;
    if($role == 1){
        return redirect()->route('user.login');
    }else{
        return redirect()->route('admin.login');
    }
})->name('role');
Route::get('/user/register', [RegisterController::class, 'registerForm'])->name('user.register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/order/add', [OrderController::class, 'orderForm']);
Route::post('/order/add', [OrderController::class, 'create']);
Route::get('/user/{id}/orders', [OrderController::class, 'show']);
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'findByCategoryId']);
Route::get('/facts/add', [FactController::class, 'showFactForms']);
Route::post('/category/add', [CategoryController::class, 'store']);
Route::post('/product/add', [ProductController::class, 'store']);
Route::post('/sourceArea/add', [SourceAreaController::class, 'store']);
Route::post('/gate/add', [GateController::class, 'store']);
Route::post('/shop/add', [ShopController::class, 'store']);
Route::post('/orders/update/{order}', [OrderController::class, 'edit'])->name('orders.update');
Route::get('orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
Route::post('/orders/edit/{order}', [OrderController::class, 'update'])->name('orders.edit');
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/sourceareas', [SourceAreaController::class, 'index']);
Route::get('/gates', [GateController::class, 'index']);
Route::get('/shops', [ShopController::class, 'index']);
Route::post('/facts/update/{id}', [FactController::class, 'edit'])->name('facts.update');
Route::delete('/facts/delete/{id}', [FactController::class, 'delete'])->name('facts.delete');
Route::get('/change-password', [UserController::class, 'showChangePasswordForm']);
Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.update');
Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('user.forgot-password');
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('user.forgot-password');
Route::get('/reset-password', [UserController::class, 'showResetPasswordForm']);
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
Route::post('/orders/export', [OrderController::class, 'exportAll'])->name('orders.export');