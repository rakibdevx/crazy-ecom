<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::before(function (Admin $admin, $ability) {
            return $admin->hasRole('Super Admin') ? true : null;
        });

        View::composer('frontend.layout.header', function ($view) {
            $view->with('menu_categories', Category::where('status', 'active')->with('subcategories.childcategories')->get());
        });
    }

}
