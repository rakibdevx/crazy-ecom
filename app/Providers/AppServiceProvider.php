<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

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

    if (Schema::hasTable('settings')) {
        $mailSettings = [
            'mail.mailer' => setting('mail_mailer', 'smtp'),
            'mail.host' => setting('mail_host', 'smtp.gmail.com'),
            'mail.port' => setting('mail_port', 465),
            'mail.username' => setting('mail_username'),
            'mail.password' => setting('mail_password'),
            'mail.encryption' => setting('mail_encryption', 'ssl'),
            'mail.from.address' => setting('mail_from_address', 'default@gmail.com'),
            'mail.from.name' => setting('mail_from_name', 'Laravel App'),
        ];

        foreach ($mailSettings as $key => $value) {
            if (!empty($value)) {
                \Config::set($key, $value);
            }
        }
    }
}

}
