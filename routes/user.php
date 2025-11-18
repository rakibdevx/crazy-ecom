<?php

use App\Http\Controllers\Frontend\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProfileController;

// auth routes
Route::middleware(['web','guest:user','user.maintenance'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'registration']);

    Route::get('forgot', [AuthController::class, 'showForgotPasswordForm'])->name('forgot');
    Route::post('forgot', [AuthController::class, 'sendResetLinkEmail'])->name('forgot.submit');

    Route::get('reset', [AuthController::class, 'showResetPasswordForm'])->name('resetPassword');
    Route::post('reset', [AuthController::class, 'resetPassword'])->name('resetPassword.submit');
});


// Otp verify
Route::prefix('user')->name('user.')->middleware('web')->group(function () {
    Route::get('otp/{email}', [AuthController::class, 'otp'])->name('otp');
    Route::post('otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
    Route::get('resend-otp/{email}', [AuthController::class, 'resendOtp'])->name('resendOtp');
});


// Email verify routes
Route::get('user/verify/{id}/{token}', [AuthController::class, 'verify'])->name('user.verify');

// Email Verification
Route::prefix('user')->name('user.')->middleware('web','auth:user')->group(function () {
    Route::get('resend-verification', [AuthController::class, 'resend'])->name('verification.resend');
    Route::get('unverified', [AuthController::class, 'unverified'])->name('unverified');

});

// user routes
Route::prefix('user')->name('user.')->middleware(['web','auth:user','auth.user','user.maintenance','user.verified'])->group(function () {

      Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');


      Route::get('/address', [AddressController::class, 'index'])->name('address');
      Route::post('/address', [AddressController::class, 'store'])->name('address.store');
      Route::post('/address/status', [AddressController::class, 'status'])->name('address.status');
      Route::get('/address/{id}', [AddressController::class, 'delete'])->name('address.delete');


    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/password-change', [ProfileController::class, 'changePassword'])->name('changePassword');
        Route::post('/image', [ProfileController::class, 'image'])->name('image');
        Route::post('/business', [ProfileController::class, 'updateBusiness'])->name('business');
        Route::post('/social', [ProfileController::class, 'updatesocial'])->name('social');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    // dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

});
