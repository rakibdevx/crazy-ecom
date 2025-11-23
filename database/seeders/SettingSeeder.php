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
            ['key' => 'site_logo', 'value' => 'backend/images/images/logo.png'],
            ['key' => 'site_logo_dark', 'value' => 'backend/images/images/logo_2.png'],
            ['key' => 'site_favicon', 'value' => 'backend/images/images/favicon.png'],
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
            ['key' => 'og_image', 'value' => 'backend/images/images/logo.png'],
            ['key' => 'twitter_card', 'value' => 'summary_large_image'],

            // 🔹 Contact & Support
            ['key' => 'support_email', 'value' => 'support@rakibdevx.com'],
            ['key' => 'support_phone', 'value' => '+8801777777777'],
            ['key' => 'contact_form_enabled', 'value' => '1'],
            ['key' => 'live_chat_enabled', 'value' => '1'],
            ['key' => 'working_hours', 'value' => '9:00 AM - 6:00 PM'],
            ['key' => 'map_embed', 'value' => 'https://maps.google.com/...'],
            ['key'=>'facebook_link','value'=>"www.facebook_link.com"],
            ['key'=>'twitter_link','value'=>"www.twitter_link.com"],
            ['key'=>'instagram_link','value'=>"www.instagram_link.com"],
            ['key'=>'youtube_link','value'=>"www.youtube_link.com"],
            ['key'=>'pinterest_link','value'=>"www.pinterest_link.com"],

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
            ['key' => 'vendor_default_status', 'value' => '1'],
            ['key' => 'user_registration_enabled', 'value' => '1'],
            ['key' => 'user_default_status', 'value' => '1'],
            ['key' => 'email_verification', 'value' => '1'],
            ['key' => 'app_debug', 'value' => '0'],
            ['key' => 'currency', 'value' => 'BDT'],
            ['key' => 'currency_symbol', 'value' => '৳'],
            ['key' => 'order_pre_text', 'value' => 'ODR_'],
            ['key' => 'date_format', 'value' => 'd-m-Y'],
            ['key' => 'time_format', 'value' => 'H:i'],
            ['key' => 'default_pagination', 'value' => '20'],


            // Theme Setting
            ['key' => 'best_selling_enable', 'value' => '1'],
            ['key' => 'hot_deals_enable', 'value' => '1'],
            ['key' => 'featured_products_enable', 'value' => '1'],
            ['key' => 'trending_products_enable', 'value' => '1'],
            ['key' => 'popular_categories_enable', 'value' => '1'],
            ['key' => 'suggest_today_enable', 'value' => '1'],
            ['key' => 'brands_enable', 'value' => '1'],

            // 🔹 Security
            ['key' => 'max_login_attempts', 'value' => '5'],
            ['key' => 'lockout_time', 'value' => '10'],
            ['key' => 'two_factor_expires_time', 'value' => '10'],
            ['key' => 'recaptcha_enabled', 'value' => '0'],
            ['key' => 'recaptcha_site_key', 'value' => 'recaptcha_site_key'],
            ['key' => 'recaptcha_secret_key', 'value' => 'recaptcha_secret_key'],

            // 🔹 Theme / UI
            ['key' => 'theme_color', 'value' => '#3b82f6'],
            ['key' => 'login_background', 'value' => 'backend/images/images/login_background.png'],
            ['key' => 'registration_background', 'value' => 'backend/images/images/registration_background.png'],
            ['key' => 'forgot_background', 'value' => 'backend/images/images/forgot_background.png'],
            ['key' => 'reset_background', 'value' => 'backend/images/images/reset_background.png'],
            ['key' => 'default_profile_image', 'value' => 'backend/images/images/default_profile.png'],
            ['key' => 'default_profile_banner', 'value' => 'backend/images/images/default_profile_banner.png'],
            ['key' => 'default_product_image', 'value' => 'backend/images/images/dafault_product_image.png'],
            ['key' => 'default_category_image', 'value' => 'backend/images/images/default_category_image.png'],
            ['key' => 'default_sub_category_image', 'value' => 'backend/images/images/default_sub_category_image.png'],
            ['key' => 'default_brand_image', 'value' => 'backend/images/images/default_brand_image.png'],
            ['key' => 'default_slider_image', 'value' => 'backend/images/images/default_slider_image.png'],
            ['key' => 'footer_payment_image', 'value' => 'backend/images/images/footer_payment_image.png'],

           // Image Upload Config
            ['key' => 'support_image_type', 'value' => 'png,jpg,jpeg,gif'],
            ['key' => 'support_image_max', 'value' => '2048'],


            // Number Config
            ['key' => 'phone_digit_min', 'value' => 9],
            ['key' => 'phone_digit_max', 'value' => 11],
        ];

        DB::table('settings')->insert($settings);

        $this->command->info('Setting seeded successfully!');
    }
}
