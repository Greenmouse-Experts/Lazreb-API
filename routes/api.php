<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response([
        'status' => true,
        'message' => 'You are now on Lazreb API Endpoints'
    ]);
});

Route::get('/login', function () {
    return response([
        'status' => true,
        'message' => 'Token Required!'
    ]);
})->name('login');

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/email/verify/resend/{email}', [AuthController::class, 'email_verify_resend']);
        Route::post('/email/confirm', [AuthController::class, 'registerConfirm'])->name('email_confirmation');

        // Password reset routes
        Route::post('password/email',  [AuthController::class, 'forget_password']);
        Route::post('password/code/check', [AuthController::class, 'code_check']);
        Route::post('password/reset', [AuthController::class, 'reset_password']);
    });

    // put all api protected routes here
    Route::middleware('auth:api')->group(function () {
        Route::post('/post/request/services/{id}', [MobileController::class, 'post_request_services']);
        Route::post('/post/partner/fleet/management', [MobileController::class, 'post_partner_fleet_management']);
        Route::get('/my-requests/hire-vehicle', [MobileController::class, 'my_requests_hire_vehicle']);
        Route::get('/my-requests/hire-vehicle/count', [MobileController::class, 'my_requests_hire_vehicle_count']);
        Route::get('/my-requests/charter-vehicle', [MobileController::class, 'my_requests_charter_vehicle']);
        Route::get('/my-requests/charter-vehicle/count', [MobileController::class, 'my_requests_charter_vehicle_count']);
        Route::get('/my-requests/lease-vehicle', [MobileController::class, 'my_requests_lease_vehicle']);
        Route::get('/my-requests/lease-vehicle/count', [MobileController::class, 'my_requests_lease_vehicle_count']);
        Route::get('/my-requests/partner-fleet-management', [MobileController::class, 'my_requests_partner_fleet_management']);
        Route::get('/my-requests/partner-fleet-management/count', [MobileController::class, 'my_requests_partner_fleet_management_count']);
        Route::post('/hire-vehicle/update/{id}', [MobileController::class, 'update_hire_vehicle']);
        Route::post('/hire-vehicle/delete/{id}', [MobileController::class, 'delete_hire_vehicle']);
        Route::post('/hire-vehicle/upload/{id}', [MobileController::class, 'upload_hire_vehicle']);
        Route::post('/charter-vehicle/update/{id}', [MobileController::class, 'update_charter_vehicle']);
        Route::post('/charter-vehicle/delete/{id}', [MobileController::class, 'delete_charter_vehicle']);
        Route::post('/charter-vehicle/upload/{id}', [MobileController::class, 'upload_charter_vehicle']);
        Route::post('/lease-vehicle/update/{id}', [MobileController::class, 'update_lease_vehicle']);
        Route::post('/lease-vehicle/delete/{id}', [MobileController::class, 'delete_lease_vehicle']);
        Route::post('/lease-vehicle/upload/{id}', [MobileController::class, 'upload_lease_vehicle']);
        Route::post('/update/partner/fleet/management/{id}', [MobileController::class, 'update_partner_fleet_management']);
        Route::post('/delete/partner/fleet/management/{id}', [MobileController::class, 'delete_partner_fleet_management']);
        Route::get('/transactions', [MobileController::class, 'transactions']);
        Route::get('/referrals', [MobileController::class, 'referrals']);
        Route::post('/profile/update', [MobileController::class, 'update_profile']);
        Route::post('/profile/update/password', [MobileController::class, 'update_password']);
        Route::post('/profile/upload/profile-picture', [MobileController::class, 'upload_profile_picture']);
        Route::get('/get/profile', [MobileController::class, 'get_profile']);

        Route::get('/services/all', [MobileController::class, 'get_all_services']);
        Route::get('/vehicle-type/all', [MobileController::class, 'get_all_vehicle_type']);

        Route::get('/get/all/notifications', [MobileController::class, 'get_all_notifications']);
        Route::get('/get/all/unread/notifications', [MobileController::class, 'get_all_unread_notifications']);
        Route::get('/count/unread/notifications', [MobileController::class, 'count_unread_notifications']);
        Route::post('/read/notification/{id}', [MobileController::class, 'read_notification']);

        Route::get('/get/promo/annoucement/first', [MobileController::class, 'get_promo_annoucement_first']);
        Route::get('/get/all/promo/annoucement', [MobileController::class, 'get_all_promo_annoucement']);

        Route::post('logout', [MobileController::class, 'logout']);
    });
    
});