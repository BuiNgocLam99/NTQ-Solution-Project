<?php

use App\Http\Controllers\Admin\AddProductsController;
use App\Http\Controllers\Admin\OrderDetailsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\SignInController;
use App\Http\Controllers\User\SignUpController;
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

Route::get('/sign-up', [SignUpController::class, 'index'])->name('user.sign-up');
Route::post('/submit-sign-up', [SignUpController::class, 'postSignUp'])->name('user.submit-sign-up');

Route::get('/sign-in', [SignInController::class, 'index'])->name('user.sign-in');
Route::post('/sign-in', [SignInController::class, 'postSignIn'])->name('user.submit-sign-in');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('user.forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'postResetPassword'])->name('user.submit-forgot-password');

Route::get('/', [HomeController::class, 'index'])->name('user.home');



Route::get('/cart', [CartController::class, 'index'])->name('user.cart');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('user.cart');

// Admin Routes
Route::get('/add-product', [AddProductsController::class, 'index'])->name('admin.add-product');
Route::post('/submit-add-product', [AddProductsController::class, 'submitForm'])->name('admin.submit-add-product');

Route::get('/products', [ProductsController::class, 'index'])->name('admin.products');

Route::get('/order-details', [OrderDetailsController::class, 'index'])->name('admin.order-details');

Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');