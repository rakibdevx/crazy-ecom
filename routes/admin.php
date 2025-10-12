<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->middleware(['web'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
});



Route::prefix('admin')->name('admin.')->middleware(['web'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'update'])->name('update');
        Route::get('/seo', [SettingController::class, 'seo'])->name('seo');
        Route::post('/seo', [SettingController::class, 'seo_update'])->name('seo.update');

        Route::get('/contact', [SettingController::class, 'contact'])->name('contact');
        Route::post('/contact', [SettingController::class, 'contact_update'])->name('contact.update');

        Route::get('/mail', [SettingController::class, 'mail'])->name('mail');
        Route::post('/mail', [SettingController::class, 'mail_update'])->name('mail.update');

        Route::get('/system', [SettingController::class, 'system'])->name('system');
        Route::post('/system', [SettingController::class, 'system_update'])->name('system.update');

        Route::get('/security', [SettingController::class, 'security'])->name('security');
        Route::post('/security', [SettingController::class, 'security_update'])->name('security.update');

        Route::get('/config', [SettingController::class, 'config'])->name('config');
        Route::post('/config', [SettingController::class, 'config_update'])->name('config.update');

        Route::get('/image', [SettingController::class, 'image'])->name('image');
        Route::post('/image', [SettingController::class, 'image_update'])->name('image.update');
    });

});
