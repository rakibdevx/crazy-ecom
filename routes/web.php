<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

    // Front end Route
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'home'])->name('home');

    // newsletters Route
    Route::post('/newsletters', [NewsletterController::class, 'store'])->name('newsletters');

    // Products
    Route::prefix('products')->name('product.')->group(function () {

        Route::get('/', [ProductController::class, 'index'])->name('index');

        Route::get('category/{slug}', [ProductController::class, 'category_product'])->name('category_product');
        Route::get('sub_category/{slug}', [ProductController::class, 'sub_category_product'])->name('sub_category_product');
        Route::get('child_category/{slug}', [ProductController::class, 'child_category_product'])->name('child_category_product');
        Route::get('brand/{slug}', [ProductController::class, 'brand_product'])->name('brand_product');
        Route::get('best_selling', [ProductController::class, 'best_selling'])->name('best_selling_product');
        Route::get('hot_deals', [ProductController::class, 'hot_deals'])->name('hot_deals_product');
        Route::get('featured', [ProductController::class, 'featured'])->name('featured_product');
        Route::get('trending', [ProductController::class, 'trending'])->name('trending_product');
        Route::get('/{slug}', [ProductController::class, 'details'])->name('details');
    });

    Route::post('/check-stock', [ProductController::class, 'checkStock'])->name('checkStock');
    Route::post('/ajax/add-to-cart', [CartController::class, 'ajaxAddToCart'])->name('cart.ajax.add');

    //  Cart
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/ajax/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.ajax.coupon');

    // Track Order
    Route::get('/track-order', [HomeController::class, 'index'])->name('track.order');


    Route::get('ssl/pay', [SslCommerzPaymentController::class, 'pay'])->name('ssl.pay');
    
    Route::post('ssl/success', [SslCommerzPaymentController::class, 'success'])->name('ssl.success');
    Route::post('ssl/fail', [SslCommerzPaymentController::class, 'fail'])->name('ssl.fail');
    Route::post('ssl/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('ssl.cancel');
    Route::post('ssl/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('ssl.ipn');
    //SSLCOMMERZ END




Route::get('/image', function () {
    $path = public_path('demo');
    if (!file_exists($path)) mkdir($path, 0755, true);

    function fetchImage($url, $path) {
        $img = @file_get_contents($url);
        if($img) file_put_contents($path, $img);
        usleep(200000); // throttle
    }

    // Category / Subcategory / Brand
    // for ($i=1;$i<=20;$i++) fetchImage("https://picsum.photos/150/150?random=".($i+100), $path."/category_$i.jpg");
    // for ($i=1;$i<=100;$i++) fetchImage("https://picsum.photos/150/150?random=".($i+200), $path."/sub_category_$i.jpg");
    // for ($i=1;$i<=20;$i++) fetchImage("https://picsum.photos/250/100?random=".($i+300), $path."/brand_$i.jpg");

    // Vendor / User Profile → AI face
    // for ($i=1;$i<=10;$i++) fetchImage("https://thispersondoesnotexist.com", $path."/vendor_$i.jpg");
    // for ($i=1;$i<=10;$i++) fetchImage("https://thispersondoesnotexist.com", $path."/user_$i.jpg");

    // // Vendor Banner / Product / Product Gallery
    // for ($i=1;$i<=10;$i++) fetchImage("https://picsum.photos/1100/600?random=".($i+400), $path."/vendor_banner_$i.jpg");


    // for ($i=91;$i<=100;$i++) fetchImage("https://picsum.photos/650/800?random=".($i+500), $path."/product_$i.jpg");
    // for ($i=1;$i<=10;$i++) fetchImage("https://picsum.photos/650/800?random=".($i+600), $path."/product_gallery_$i.jpg");

    // for ($i=1;$i<=3;$i++) fetchImage("https://picsum.photos/700/480?random=".($i+600), $path."/slider_$i.jpg");

    return "All demo images downloaded successfully!";
});



