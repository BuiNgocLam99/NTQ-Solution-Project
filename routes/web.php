<?php

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
