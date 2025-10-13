<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ProfileController;

// auth routes

Route::prefix('vendor')->name('vendor.')->middleware(['web','guest:vendor','vendor.maintenance'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('registration', [AuthController::class, 'showRegistrationForm'])->name('registration');
    Route::post('registration', [AuthController::class, 'registration'])->name('registration.submit');

    Route::get('forgot', [AuthController::class, 'showForgotPasswordForm'])->name('forgot');
    Route::post('forgot', [AuthController::class, 'sendResetLinkEmail'])->name('forgot.submit');

    Route::get('reset', [AuthController::class, 'showResetPasswordForm'])->name('resetPassword');
    Route::post('reset', [AuthController::class, 'resetPassword'])->name('resetPassword.submit');
});

// email verify routes
Route::get('vendor/verify/{id}/{token}', [AuthController::class, 'verify'])->name('vendor.verify');

Route::prefix('vendor')->name('vendor.')->middleware('web','auth:vendor')->group(function () {
    Route::get('resend-verification', [AuthController::class, 'resend'])->name('verification.resend');
    Route::get('unverified', [AuthController::class, 'unverified'])->name('unverified');

});

// vendor routes
Route::prefix('vendor')->name('vendor.')->middleware(['web','auth:vendor','auth.vendor','vendor.maintenance','vendor.verified'])->group(function () {

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

});
