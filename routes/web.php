<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

    //FrontEnd Pages
Route::get('/test', [App\Http\Controllers\HomePageController::class, 'test']);

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('index');



//Authications Pages
Route::get('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('log');
Route::get('/signUp', [App\Http\Controllers\AuthController::class, 'sign'])->name('sign');
Route::get('/forgot', [App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot');
Route::get('/admin/login', [AuthController::class, 'admin'])->name('admin');
Route::post('/admin/login', [AuthController::class, 'admin_login'])->name('admin.login');

//User Authentications
Route::prefix('auth')->group(function () {
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::get('/verify/account/{email}', [App\Http\Controllers\AuthController::class, 'verify_account'])->name('verify.account');
    Route::post('/email/verify/resend/{email}', [App\Http\Controllers\AuthController::class, 'email_verify_resend'])->name('email.verify.resend');
    Route::post('/email/confirm/{token}', [App\Http\Controllers\AuthController::class, 'registerConfirm'])->name('email.confirmation');
    Route::post('/user/login', [App\Http\Controllers\AuthController::class, 'user_login'])->name('user.login');
    Route::post('/password/forget',  [App\Http\Controllers\AuthController::class, 'password_forget'])->name('user.forget.password');
    Route::get('/reset/password/email/{email}', [App\Http\Controllers\AuthController::class, 'password_reset_email'])->name('user.reset.password');
    Route::post('update/password/reset/', [App\Http\Controllers\AuthController::class, 'password_reset'])->name('user.update.new.password');
});


Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// User
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/request-services', [DashboardController::class, 'request_services'])->name('user.request.services');
    Route::get('/become-a-partner', [DashboardController::class, 'become_a_partner'])->name('user.become.a.partner');
    Route::get('/notifications', [DashboardController::class, 'notifications'])->name('user.notifications');
    Route::get('/transactions', [DashboardController::class, 'transactions'])->name('user.transactions');
    Route::get('/help/support', [DashboardController::class, 'help_support'])->name('user.help.support');
    Route::get('/referrals', [DashboardController::class, 'referrals'])->name('user.referrals');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('user.settings');
    Route::post('/profile/update', [DashboardController::class, 'update_profile'])->name('user.update.profile');
    Route::post('/profile/update/password', [DashboardController::class, 'update_password'])->name('user.update.password');
    Route::post('/profile/upload/profile-picture', [DashboardController::class, 'upload_profile_picture'])->name('user.profile.picture');
});

// Administrator
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/add/service', [AdminController::class, 'service'])->name('admin.service');
    Route::post('/admin/add/service', [AdminController::class, 'add_service'])->name('admin.add.service');
    Route::get('/admin/get/services', [AdminController::class, 'services'])->name('admin.get.services');
    Route::post('/admin/update/service/{id}', [AdminController::class, 'update_service'])->name('admin.update.service');
    Route::post('/admin/delete/service/{id}', [AdminController::class, 'delete_service'])->name('admin.delete.service');
});
