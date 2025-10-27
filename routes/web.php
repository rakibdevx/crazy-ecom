<?php

use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Routes

    Route::get('/login', function () {
        return "login";
    })->name('login');

    Route::get('/home', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('vendor')->check()) {
            return redirect()->route('vendor.dashboard');
        }
        return redirect('/');
    })->name('home');



// Front end Route
    Route::get('/', [HomeController::class, 'index'])->name('index');


    // newsletters Route
    Route::post('/newsletters', [NewsletterController::class, 'store'])->name('newsletters');

    // Products
    Route::prefix('products')->name('product.')->group(function () {

        Route::get('/', [ProductController::class, 'index'])->name('index');

        Route::get('category/{slug}', [ProductController::class, 'category_product'])->name('category_product');
        Route::get('sub_category/{slug}', [ProductController::class, 'sub_category_product'])->name('sub_category_product');
        Route::get('child_category/{slug}', [ProductController::class, 'child_category_product'])->name('child_category_product');

    });

    Route::get('/track-order', [HomeController::class, 'index'])->name('track.order');
