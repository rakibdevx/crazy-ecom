<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Rakib Dev X Academy'],
            ['key' => 'site_description', 'value' => 'A complete online learning platform for everyone.'],
            ['key' => 'site_logo', 'value' => 'backend/images/logo-icon.png'],
            ['key' => 'site_logo_dark', 'value' => 'backend/images/logo-icon.png'],
            ['key' => 'site_favicon', 'value' => 'backend/images/favicon-32x32.png'],
            ['key' => 'address', 'value' => 'House 123, Road 4, Dhanmondi, Dhaka'],
            ['key' => 'timezone', 'value' => 'Asia/Dhaka'],
            ['key' => 'default_language', 'value' => 'en'],
            ['key' => 'footer_text', 'value' => '© 2025 Rakib Dev X Academy. All rights reserved.'],

            // 🔹 SEO Settings
            ['key' => 'meta_title', 'value' => 'Rakib Dev X Academy - Online Courses & Tutorials'],
            ['key' => 'meta_description', 'value' => 'Learn online with top instructors and skill-based courses.'],
            ['key' => 'meta_keywords', 'value' => 'courses, online learning, education, Rakib Dev X academy'],
            ['key' => 'og_title', 'value' => 'Rakib Dev X Academy'],
            ['key' => 'og_description', 'value' => 'Join Rakib Dev X Academy to learn anything, anytime!'],
            ['key' => 'og_image', 'value' => 'backend/images/og.png'],
            ['key' => 'twitter_card', 'value' => 'summary_large_image'],

            // 🔹 Contact & Support
            ['key' => 'support_email', 'value' => 'support@rakibdevx.com'],
            ['key' => 'support_phone', 'value' => '+8801777777777'],
            ['key' => 'contact_form_enabled', 'value' => '1'],
            ['key' => 'live_chat_enabled', 'value' => '1'],
            ['key' => 'working_hours', 'value' => '9:00 AM - 6:00 PM'],
            ['key' => 'map_embed', 'value' => 'https://maps.google.com/...'],

            // 🔹 Mail Settings
            ['key' => 'mail_mailer', 'value' => 'smtp'],
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io'],
            ['key' => 'mail_port', 'value' => '2525'],
            ['key' => 'mail_username', 'value' => 'username'],
            ['key' => 'mail_password', 'value' => 'password'],
            ['key' => 'mail_encryption', 'value' => 'tls'],
            ['key' => 'mail_from_address', 'value' => 'noreply@rakibdevx.com'],
            ['key' => 'mail_from_name', 'value' => 'RakibDevX Academy'],

            // 🔹 Payment Gateway
            ['key' => 'payment_gateway', 'value' => 'sslcommerz'],
            ['key' => 'payment_mode', 'value' => 'sandbox'],
            ['key' => 'sslcommerz_store_id', 'value' => 'store_12345'],
            ['key' => 'sslcommerz_store_password', 'value' => 'abcd1234'],
            ['key' => 'paypal_client_id', 'value' => ''],
            ['key' => 'paypal_secret', 'value' => ''],
            ['key' => 'stripe_key', 'value' => ''],
            ['key' => 'stripe_secret', 'value' => ''],

            // 🔹 SMS / Notification
            ['key' => 'sms_gateway', 'value' => 'twilio'],
            ['key' => 'sms_api_key', 'value' => ''],
            ['key' => 'sms_sender_id', 'value' => 'rakibdevx'],
            ['key' => 'email_notification', 'value' => '1'],
            ['key' => 'sms_notification', 'value' => '1'],
            ['key' => 'push_notification', 'value' => '0'],

            // 🔹 System / App Config
            ['key' => 'front_maintenance_mode', 'value' => '0'],
            ['key' => 'vendor_maintenance_mode', 'value' => '0'],
            ['key' => 'vendor_registration_enabled', 'value' => '1'],
            ['key' => 'user_registration_enabled', 'value' => '1'],
            ['key' => 'email_verification', 'value' => '1'],
            ['key' => 'app_debug', 'value' => '0'],
            ['key' => 'currency', 'value' => 'BDT'],
            ['key' => 'currency_symbol', 'value' => '৳'],
            ['key' => 'date_format', 'value' => 'd-m-Y'],
            ['key' => 'time_format', 'value' => 'H:i'],
            ['key' => 'default_pagination', 'value' => '20'],

            // 🔹 Security
            ['key' => 'max_login_attempts', 'value' => '5'],
            ['key' => 'lockout_time', 'value' => '10'],
            ['key' => 'two_factor_expires_time', 'value' => '10'],
            ['key' => 'recaptcha_enabled', 'value' => '0'],
            ['key' => 'recaptcha_site_key', 'value' => 'recaptcha_site_key'],
            ['key' => 'recaptcha_secret_key', 'value' => 'recaptcha_secret_key'],

            // 🔹 Theme / UI
            ['key' => 'theme_color', 'value' => '#3b82f6'],
            ['key' => 'login_background', 'value' => 'backend/images/login-bg.jpg'],
            ['key' => 'registration_background', 'value' => 'backend/images/login-bg.jpg'],
            ['key' => 'forgot_background', 'value' => 'backend/images/login-bg.jpg'],
            ['key' => 'reset_background', 'value' => 'backend/images/login-bg.jpg'],
            ['key' => 'default_profile_image', 'value' => 'backend/images/login-bg.jpg'],
            ['key' => 'default_profile_banner', 'value' => 'backend/images/login-bg.jpg'],
            ['key' => 'default_product_image', 'value' => 'backend/images/login-bg.jpg'],

           // Image Upload Config
            ['key' => 'support_image_type', 'value' => 'png,jpg,jpeg,gif'],
            ['key' => 'support_image_max', 'value' => '2048'],


            // Number Config
            ['key' => 'phone_digit_min', 'value' => 9],
            ['key' => 'phone_digit_max', 'value' => 11],
        ];

        DB::table('settings')->insert($settings);
    }
}
