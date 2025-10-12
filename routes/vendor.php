<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\DashboardController;


Route::prefix('vendor')->name('vendor.')->middleware(['web','guest:vendor'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('registration', [AuthController::class, 'showRegistrationForm'])->name('registration');
    Route::post('registration', [AuthController::class, 'registration'])->name('registration.submit');

    Route::get('forgot', [AuthController::class, 'showForgotPasswordForm'])->name('forgot');
    Route::post('forgot', [AuthController::class, 'sendResetLinkEmail'])->name('forgot.submit');

    Route::get('reset', [AuthController::class, 'showResetPasswordForm'])->name('resetPassword');
    Route::post('reset', [AuthController::class, 'resetPassword'])->name('resetPassword.submit');

});


Route::prefix('vendor')->name('vendor.')->middleware(['web','auth:vendor','auth.vendor'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



});
