<?php

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
Route::post('/sign-up', [SignUpController::class, 'postSignUp'])->name('user.post-sign-up');

Route::get('/sign-in', [SignInController::class, 'index'])->name('user.sign-in');
Route::post('/sign-in', [SignInController::class, 'postSignIn'])->name('user.post-sign-in');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('user.forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'postResetPassword'])->name('user.post-forgot-password');

Route::get('/', [HomeController::class, 'index'])->name('user.home');
