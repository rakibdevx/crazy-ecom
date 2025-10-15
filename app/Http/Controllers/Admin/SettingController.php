<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeZone;
use App\Models\Setting;
use App\Rules\ValidImage;
use Flasher\Notyf\Prime\NotyfInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;


class SettingController extends Controller
{
    public function index()
    {
        $time_zones = TimeZone::get();
        return view('backend.admin.setting.index',compact('time_zones'));
    }

    public function update(Request $request)
    {
        // Validation
        $request->validate([
            'site_name'        => 'required|string|max:40|min:2',
            'address'          => 'required|string|min:5|max:100',
            'timezone'          => 'required|exists:time_zones,name',
            'site_description' => 'required|string|max:500|min:10',
            'footer_text'      => 'required|string|max:500|min:10',
            'site_logo'        => ['nullable', 'file', new ValidImage()],
            'site_logo_dark'   => ['nullable', 'file', new ValidImage()],
            'site_favicon'     => ['nullable', 'file', new ValidImage()],
        ]);

        Setting::updateOrCreate(['key' => 'site_name'],['value' => $request->site_name]);
        if($request->site_name != setting('site_name'))
        {
            $this->env_update('APP_NAME', '"' . addslashes($request->site_name) . '"');
        }
        Setting::updateOrCreate(['key' => 'address'],['value' => $request->address]);
        Setting::updateOrCreate(['key' => 'timezone'],['value' => $request->timezone]);
        Setting::updateOrCreate(['key' => 'site_description'],['value' => $request->site_description]);
        Setting::updateOrCreate(['key' => 'footer_text'],['value' => $request->footer_text]);

        // return Setting::all();
        $imageSettings = ['site_logo', 'site_logo_dark', 'site_favicon'];
        foreach ($imageSettings as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                if (setting($key)) {
                    $oldPath = public_path(setting($key));
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/images/logo'), $filename);
                Setting::updateOrCreate(['key' => $key],['value' => 'backend/images/logo/' . $filename]);
            }
        }
        clearSettingCache();
        return redirect()->back()->with('success', 'Settings updated successfully!');

    }

    public function seo()
    {
        return view('backend.admin.setting.seo');
    }

    public function seo_update(Request $request)
    {
        $request->validate([
            'meta_title'=>'required|string|max:90|min:2',
            'meta_description'=>'required|string|max:250|min:10',
            'meta_keywords'=>'required|string|max:90|min:2',
            'og_title'=>'required|string|max:90|min:2',
            'og_description'=>'required|string|max:250|min:10',
            'twitter_card'     => ['nullable', 'file', new ValidImage()],
            'og_image'     => ['nullable', 'file', new ValidImage()],
        ]);

        Setting::updateOrCreate(['key' => 'meta_title'],['value' => $request->meta_title]);
        Setting::updateOrCreate(['key' => 'meta_description'],['value' => $request->meta_description]);
        Setting::updateOrCreate(['key' => 'meta_keywords'],['value' => $request->meta_keywords]);
        Setting::updateOrCreate(['key' => 'og_title'],['value' => $request->og_title]);
        Setting::updateOrCreate(['key' => 'og_description'],['value' => $request->og_description]);
        $imageSettings = ['twitter_card', 'og_image'];
        foreach ($imageSettings as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                if (setting($key)) {
                    $oldPath = public_path(setting($key));
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/images/meta'), $filename);
                Setting::updateOrCreate(['key' => $key],['value' => 'backend/images/meta/' . $filename]);
            }
        }

        clearSettingCache();
        return redirect()->back()->with('success', 'Seo updated successfully!');
    }

    public function contact()
    {
        return view('backend.admin.setting.contact');
    }

    public function contact_update(Request $request)
    {
        $request->validate([
            'support_email' => 'required|email|max:90',
            'support_phone' => [
                'required',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'contact_form_enabled' => 'required|boolean',
            'live_chat_enabled' => 'required|boolean',
            'working_hours' => 'required|string|min:5|max:100',
            'map_embed' => [
                'required',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?google\.com\/maps/i'
            ],
        ]);


        Setting::updateOrCreate(['key' => 'support_email'],['value' => $request->support_email]);
        Setting::updateOrCreate(['key' => 'support_phone'],['value' => $request->support_phone]);
        Setting::updateOrCreate(['key' => 'contact_form_enabled'],['value' => $request->contact_form_enabled]);
        Setting::updateOrCreate(['key' => 'live_chat_enabled'],['value' => $request->live_chat_enabled]);
        Setting::updateOrCreate(['key' => 'working_hours'],['value' => $request->working_hours]);
        Setting::updateOrCreate(['key' => 'map_embed'],['value' => $request->map_embed]);

        clearSettingCache();
        return redirect()->back()->with('success', 'Contact updated successfully!');
    }

     public function mail()
    {
        return view('backend.admin.setting.mail');
    }

    public function mail_update(Request $request)
    {
        $request->validate([
            'mail_mailer' => ['required', 'string', 'max:50', 'regex:/^\S+$/'],
            'mail_host' => ['required', 'string', 'max:100', 'regex:/^\S+$/'],
            'mail_port' => ['required', 'numeric'],
            'mail_username' => ['required', 'string', 'max:100', 'regex:/^\S+$/'],
            'mail_password' => ['required', 'string', 'max:100', 'regex:/^\S+$/'],
            'mail_encryption' => ['nullable', 'string', 'max:20', 'regex:/^\S*$/'],
            'mail_from_address' => ['required', 'email', 'max:90', 'regex:/^\S+$/'],
            'mail_from_name' => ['required', 'string', 'max:50',],
        ], [
            'regex' => 'The :attribute must not contain spaces.',
        ]);

        Setting::updateOrCreate(['key' => 'mail_mailer'],['value' => $request->mail_mailer]);
        Setting::updateOrCreate(['key' => 'mail_host'],['value' => $request->mail_host]);
        Setting::updateOrCreate(['key' => 'mail_port'],['value' => $request->mail_port]);
        Setting::updateOrCreate(['key' => 'mail_username'],['value' => $request->mail_username]);
        Setting::updateOrCreate(['key' => 'mail_password'],['value' => $request->mail_password]);
        Setting::updateOrCreate(['key' => 'mail_encryption'],['value' => $request->mail_encryption]);
        Setting::updateOrCreate(['key' => 'mail_from_address'],['value' => $request->mail_from_address]);
        Setting::updateOrCreate(['key' => 'mail_from_name'],['value' => $request->mail_from_name]);

        $this->env_update('MAIL_MAILER', $request->mail_mailer);
        $this->env_update('MAIL_HOST', $request->mail_host);
        $this->env_update('MAIL_PORT', $request->mail_port);
        $this->env_update('MAIL_USERNAME', $request->mail_username);
        $this->env_update('MAIL_PASSWORD', $request->mail_password);
        $this->env_update('MAIL_ENCRYPTION', $request->mail_encryption);
        $this->env_update('MAIL_FROM_ADDRESS', $request->mail_from_address);
        $this->env_update('MAIL_FROM_NAME', '"' . addslashes($request->mail_from_name) . '"');

        clearSettingCache();
        return redirect()->back()->with('success', 'Mail updated successfully!');
    }

    public function system()
    {
        return view('backend.admin.setting.system');
    }

    public function system_update(Request $request)
    {
        $request->validate([
            'front_maintenance_mode' => 'required|boolean',
            'vendor_maintenance_mode' => 'required|boolean',
            'user_registration_enabled' => 'required|boolean',
            'vendor_registration_enabled' => 'required|boolean',
            'email_verification' => 'required|boolean',
            'app_debug' => 'required|boolean',
            'currency' => 'required|string|max:10',
            'currency_symbol' => 'required|string|max:5',
            'date_format' => 'required|string|max:20',
            'time_format' => 'required|string|max:20',
            'default_pagination' => 'required|integer|min:1|max:500',
        ]);


        Setting::updateOrCreate(['key' => 'front_maintenance_mode'],['value' => $request->front_maintenance_mode]);
        Setting::updateOrCreate(['key' => 'vendor_maintenance_mode'],['value' => $request->vendor_maintenance_mode]);
        Setting::updateOrCreate(['key' => 'user_registration_enabled'],['value' => $request->user_registration_enabled]);
        Setting::updateOrCreate(['key' => 'vendor_registration_enabled'],['value' => $request->vendor_registration_enabled]);
        Setting::updateOrCreate(['key' => 'email_verification'],['value' => $request->email_verification]);
        Setting::updateOrCreate(['key' => 'app_debug'],['value' => $request->app_debug]);
        $debugValue = $request->app_debug == 1 ? 'true' : 'false';
        $this->env_update('APP_DEBUG', $debugValue);
        Setting::updateOrCreate(['key' => 'currency'],['value' => $request->currency]);
        Setting::updateOrCreate(['key' => 'currency_symbol'],['value' => $request->currency_symbol]);
        Setting::updateOrCreate(['key' => 'date_format'],['value' => $request->date_format]);
        Setting::updateOrCreate(['key' => 'time_format'],['value' => $request->time_format]);
        Setting::updateOrCreate(['key' => 'default_pagination'],['value' => $request->default_pagination]);

        clearSettingCache();
        return redirect()->back()->with('success', 'System updated successfully!');
    }
    public function security()
    {
        return view('backend.admin.setting.security');
    }

    public function security_update(Request $request)
    {
        $request->validate([
            'max_login_attempts' => 'required|integer|min:1|max:20',
            'lockout_time' => 'required|integer|min:1|max:1440',
            'two_factor_expires_time' => 'required|integer|min:1|max:1440',
            'recaptcha_enabled' => 'required|boolean',
            'recaptcha_site_key' => 'nullable|string|max:255',
            'recaptcha_secret_key' => 'nullable|string|max:255',
        ]);

        Setting::updateOrCreate(['key' => 'max_login_attempts'],['value' => $request->max_login_attempts]);
        Setting::updateOrCreate(['key' => 'lockout_time'],['value' => $request->lockout_time]);
        Setting::updateOrCreate(['key' => 'two_factor_expires_time'],['value' => $request->two_factor_expires_time]);
        Setting::updateOrCreate(['key' => 'recaptcha_enabled'],['value' => $request->recaptcha_enabled]);
        Setting::updateOrCreate(['key' => 'recaptcha_site_key'],['value' => $request->recaptcha_site_key]);
        Setting::updateOrCreate(['key' => 'recaptcha_secret_key'],['value' => $request->recaptcha_secret_key]);

        clearSettingCache();
        return redirect()->back()->with('success', 'Security updated successfully!');
    }
    public function config()
    {
        return view('backend.admin.setting.config');
    }

    public function config_update(Request $request)
    {
        $request->validate([
            'support_image_type' => 'required|string',
            'support_image_max' => 'required|integer|min:1|max:10000',
            'phone_digit_min' => 'required|integer|min:1|max:20',
            'phone_digit_max' => 'required|integer|min:1|max:20|gte:phone_digit_min',
        ]);

        Setting::updateOrCreate(['key' => 'support_image_type'],['value' => $request->support_image_type]);
        Setting::updateOrCreate(['key' => 'support_image_max'],['value' => $request->support_image_max]);
        Setting::updateOrCreate(['key' => 'phone_digit_min'],['value' => $request->phone_digit_min]);
        Setting::updateOrCreate(['key' => 'phone_digit_max'],['value' => $request->phone_digit_max]);

        clearSettingCache();
        return redirect()->back()->with('success', 'Config updated successfully!');
    }

    public function image()
    {
        return view('backend.admin.setting.image');
    }

    public function image_update(Request $request)
    {
        $request->validate([
            'login_background'=> ['nullable', 'file', new ValidImage()],
            'registration_background'=> ['nullable', 'file', new ValidImage()],
            'forgot_background'=> ['nullable', 'file', new ValidImage()],
            'reset_background'=> ['nullable', 'file', new ValidImage()],
            'default_profile_image'=> ['nullable', 'file', new ValidImage()],
            'default_product_image'=> ['nullable', 'file', new ValidImage()],
            'default_profile_banner'=> ['nullable', 'file', new ValidImage()],
        ]);

        $imageSettings = ['login_background', 'registration_background', 'forgot_background','reset_background','default_profile_image','default_product_image','default_profile_banner'];
        foreach ($imageSettings as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                if (setting($key)) {
                    $oldPath = public_path(setting($key));
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/images/default'), $filename);
                Setting::updateOrCreate(['key' => $key],['value' => 'backend/images/default/' . $filename]);
            }
        }
        clearSettingCache();
        return redirect()->back()->with('success', 'Image updated successfully!');
    }

    public function testMail(Request $request)
    {
        $request->validate([
            'sent_to_mail' => 'required|email',
            'sent_message' => 'required|string',
        ]);

        try {
            Mail::raw($request->sent_message, function($message) use ($request) {
                $message->to($request->sent_to_mail)
                        ->subject('Test Email')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return back()->with('success', 'Test email sent successfully!');
        } catch (\Exception $e) {
            \Log::error('Mail failed: ' . $e->getMessage());
            return back()->withErrors(['mail' => 'Failed to send test email: ' . $e->getMessage()]);
        }
    }
    private function env_update($key, $value)
    {
        $envPath = base_path('.env');
        if (!file_exists($envPath)) {
            return false;
        }

        $content = file_get_contents($envPath);
        $pattern = "/^" . preg_quote($key, '/') . "=.*/m";

        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $key . '=' . $value, $content);
        } else {
            $content .= "\n" . $key . '=' . $value;
        }
        file_put_contents($envPath, $content);
        return true;
    }

   public function clear(Request $request)
    {
        try {
            \Artisan::call('optimize:clear');
            \Artisan::call('event:clear');
            \Artisan::call('queue:clear');
            \Artisan::call('clear-compiled');
            \Cache::forget('settings_cache');
            if (function_exists('clearSettingCache')) {
                clearSettingCache();
            }

            return back()->with('success', '🔥 All caches (config, route, view, compiled, settings_cache) cleared successfully!');
        } catch (\Throwable $e) {
            return back()->with(['error' => '❌ Cache clear failed: ' . $e->getMessage()]);
        }
    }
}
