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
Route::get('/about', [App\Http\Controllers\HomePageController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomePageController::class, 'services'])->name('services');
Route::get('/faqs', [App\Http\Controllers\HomePageController::class, 'faqs'])->name('faqs');
Route::get('/contact', [App\Http\Controllers\HomePageController::class, 'contact'])->name('contact');



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
    Route::get('/my-request', [DashboardController::class, 'my_requests'])->name('user.my.requests');
    Route::get('/view-my-request/{id}', [DashboardController::class, 'view_my_requests'])->name('user.view.my.requests');
    Route::post('/hire-vehicle/update/{id}', [DashboardController::class, 'update_hire_vehicle'])->name('user.update.hire.vehicle');
    Route::post('/hire-vehicle/delete/{id}', [DashboardController::class, 'delete_hire_vehicle'])->name('user.delete.hire.vehicle');
    Route::post('/charter-vehicle/update/{id}', [DashboardController::class, 'update_charter_vehicle'])->name('user.update.charter.vehicle');
    Route::post('/charter-vehicle/delete/{id}', [DashboardController::class, 'delete_charter_vehicle'])->name('user.delete.charter.vehicle');
    Route::post('/lease-vehicle/update/{id}', [DashboardController::class, 'update_lease_vehicle'])->name('user.update.lease.vehicle');
    Route::post('/lease-vehicle/delete/{id}', [DashboardController::class, 'delete_lease_vehicle'])->name('user.delete.lease.vehicle');
    Route::post('/partner-fleet-management/update/{id}', [DashboardController::class, 'update_partner_fleet_management'])->name('user.update.partner.fleet.management');
    Route::post('/partner-fleet-management/delete/{id}', [DashboardController::class, 'delete_partner_fleet_management'])->name('user.delete.partner.fleet.management');
    Route::get('/get/service/{id}', [DashboardController::class, 'get_service'])->name('user.get.service');
    Route::post('/post/request/service/{id}', [DashboardController::class, 'post_request_service'])->name('user.post.request.service');
    Route::get('/become-a-partner', [DashboardController::class, 'become_a_partner'])->name('user.become.a.partner');
    Route::post('/post/become/partner', [DashboardController::class, 'post_become_partner'])->name('user.post.become.partner');
    Route::get('/manage/become-a-partner', [DashboardController::class, 'manage_become_a_partner'])->name('user.manage.become.a.partner');
    Route::post('/delete/become/partner/{id}', [DashboardController::class, 'delete_become_partner'])->name('user.delete.become.partner');
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
    Route::get('/admin/users/services/requests', [AdminController::class, 'users_services_requests'])->name('admin.users.services.requests');
    Route::get('/admin/users/partnership/requests', [AdminController::class, 'users_partnership_requests'])->name('admin.users.partnership.requests');
    Route::get('/admin/users/notifications', [AdminController::class, 'users_notifications'])->name('admin.users.notifications');
    Route::get('/admin/users/transactions', [AdminController::class, 'users_transactions'])->name('admin.users.transactions');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/profile/update', [AdminController::class, 'admin_update_profile'])->name('admin.update.profile');
    Route::post('/admin/profile/update/password', [AdminController::class, 'admin_update_password'])->name('admin.update.password');
    Route::post('/admin/profile/upload/profile-picture', [AdminController::class, 'admin_upload_profile_picture'])->name('admin.profile.picture');
});
