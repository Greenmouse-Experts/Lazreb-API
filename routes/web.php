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

Route::get('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('log');
Route::get('/signUp', [App\Http\Controllers\AuthController::class, 'sign'])->name('sign');

//User Authentications
Route::prefix('auth')->group(function () {
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::get('/verify/account/{email}', [App\Http\Controllers\HomePageController::class, 'verify_account'])->name('verify.account');
    Route::post('/email/verify/resend/{email}', [App\Http\Controllers\HomePageController::class, 'email_verify_resend'])->name('email.verify.resend');
    Route::post('/email/confirm/{token}', [App\Http\Controllers\HomePageController::class, 'registerConfirm'])->name('email.confirmation');
    Route::post('/user/login', [App\Http\Controllers\HomePageController::class, 'user_login'])->name('user.login');
    Route::post('/password/forget',  [App\Http\Controllers\HomePageController::class, 'forget_password'])->name('user.forget.password');
    Route::get('/reset/password/email/{email}', [App\Http\Controllers\HomePageController::class, 'password_reset_email'])->name('user.reset.password');
    Route::post('update/password/reset/', [App\Http\Controllers\HomePageController::class, 'reset_password'])->name('user.update.password');
});
