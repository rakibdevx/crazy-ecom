<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CommissionRulsController;
use App\Http\Controllers\Admin\ShippingZoneController;
use App\Http\Controllers\Admin\ShipingRateController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CommentController;



// login route
Route::prefix('admin')->name('admin.')->middleware(['web','guest:admin'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
});

Route::prefix('admin')->name('admin.')->middleware('web')->group(function () {
    Route::get('otp/{email}', [AuthController::class, 'otp'])->name('otp');
    Route::post('otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
    Route::get('resend-otp/{email}', [AuthController::class, 'resendOtp'])->name('resendOtp');
});

Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','auth.admin'])->group(function () {
    // dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/password-change', [ProfileController::class, 'changePassword'])->name('changePassword');
        Route::post('/image', [ProfileController::class, 'image'])->name('image');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // role and permissions
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    // Admin Routes
    Route::resource('admin', AdminController::class);
    Route::get('/admin/login/{id}', [AdminController::class, 'login'])->name('admin.login');

    // vendor routess
    Route::resource('vendor', VendorController::class);
    Route::get('/vendor/login/{id}', [VendorController::class, 'login'])->name('vendor.login');
    Route::get('/vendor/verify/{id}', [VendorController::class, 'verify'])->name('vendor.verify');


    // Customer Routes
    Route::resource('user', UserController::class);
    Route::get('/user/login/{id}', [UserController::class, 'login'])->name('user.login');
    Route::get('/user/verify/{id}', [UserController::class, 'verify'])->name('user.verify');

    // Category Route
    Route::resource('category', CategoryController::class)->except('show');

    // Sub Category Route
    Route::resource('sub_category', SubCategoryController::class)->except('show');

    // Child Category
    Route::resource('child_category', ChildCategoryController::class)->except('show');
    Route::get('/get-subcategories', [ChildCategoryController::class, 'getByCategory'])->name('getSubCategories');

    // Brand
    Route::resource('brand', BrandController::class)->except('show');

    // Size Route
    Route::resource('size', SizeController::class)->except('show');

    // Color Route
    Route::resource('color', ColorController::class)->except('show');

    // commission routes
    Route::resource('commission', CommissionController::class)->except('show');

    // commission ruls Routes
    Route::resource('commission-rule', CommissionRulsController::class)->except('show');

    // Siping Zone Routes
    Route::resource('shipping_zone', ShippingZoneController::class)->except('show');

    // Siping Zone Routes
    Route::resource('shipping', ShipingRateController::class)->except('show','create','update','edit','destroy');
    Route::get('/shipping/default', [ShipingRateController::class, 'default'])->name('shipping.default');

    // Product Routes
    Route::resource('product', ProductController::class);
    Route::post('product/delete-media', [ProductController::class, 'deleteMedia'])->name('product.deleteMedia');
    Route::post('product/bulkUpdate', [ProductController::class, 'bulkUpdate'])->name('product.bulkUpdate');
    Route::get('products/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.getSubCategories');
    Route::get('products/get-childcategories', [ProductController::class, 'getChildCategories'])->name('product.getChildCategories');

    Route::resource('coupon', CouponController::class);
    Route::get('coupon/subcategories-by-category/{id}', [CouponController::class, 'getSubcategories'])->name('coupon.getSubcategories');
    Route::get('coupon/childcategories-by-subcategory/{id}', [CouponController::class, 'getChildCategories'])->name('coupon.getChildCategories');

    Route::resource('comment', CommentController::class)->except('create','store','edit','update');


    // setting routes
    Route::prefix('setting')->name('setting.')->group(function () {

        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'update'])->name('update');
        Route::get('/seo', [SettingController::class, 'seo'])->name('seo');
        Route::post('/seo', [SettingController::class, 'seo_update'])->name('seo.update');

        Route::get('/contact', [SettingController::class, 'contact'])->name('contact');
        Route::post('/contact', [SettingController::class, 'contact_update'])->name('contact.update');

        Route::get('/mail', [SettingController::class, 'mail'])->name('mail');
        Route::post('/mail', [SettingController::class, 'mail_update'])->name('mail.update');
        Route::post('/check', [SettingController::class, 'testMail'])->name('mail.check');

        Route::get('/system', [SettingController::class, 'system'])->name('system');
        Route::post('/system', [SettingController::class, 'system_update'])->name('system.update');

        Route::get('/security', [SettingController::class, 'security'])->name('security');
        Route::post('/security', [SettingController::class, 'security_update'])->name('security.update');

        Route::get('/config', [SettingController::class, 'config'])->name('config');
        Route::post('/config', [SettingController::class, 'config_update'])->name('config.update');

        Route::get('/image', [SettingController::class, 'image'])->name('image');
        Route::post('/image', [SettingController::class, 'image_update'])->name('image.update');

        Route::get('/clear', [SettingController::class, 'clear'])->name('clear');

        Route::get('/mail-template', [MailTemplateController::class, 'index'])->name('mail.template.index');
        Route::get('/mail-template/edit/{id}', [MailTemplateController::class, 'edit'])->name('mail.template.edit');
        Route::post('/mail-template/edit/{id}', [MailTemplateController::class, 'update'])->name('mail.template.update');
    });
});
