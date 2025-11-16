<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Vendor;
use App\Http\Middleware\User;
use App\Http\Middleware\VendorMaintenanceMode;
use App\Http\Middleware\VendorVerify;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function ($router) {
            require base_path('routes/admin.php');
            require base_path('routes/vendor.php');
            require base_path('routes/user.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.admin' => Admin::class,
            'auth.vendor' => Vendor::class,
            'auth.user' => User::class,
            'vendor.maintenance' => VendorMaintenanceMode::class,
            'user.maintenance' => VendorMaintenanceMode::class,
            'vendor.verified' => VendorVerify::class,
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
