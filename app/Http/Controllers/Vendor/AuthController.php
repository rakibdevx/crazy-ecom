<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use URL;
use Mail;


class AuthController extends Controller
{
    //  * LOGIN
    public function showLoginForm()
    {
        return view('backend.vendor.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        $vendor = \App\Models\Vendor::where('email', $request->email)->first();

        if ($vendor) {
            $maxAttempts = (int) setting('max_login_attempts');
            $lockoutMinutes = (int) setting('lockout_time');

            // Check if account is locked
            if ($vendor->lockout_time && now()->lessThan($vendor->lockout_time)) {
                $minutes = now()->diffInMinutes($vendor->lockout_time);
                return back()->withErrors(['email' => "Account locked. Try again in {$minutes} minutes."]);
            }

            $remember = $request->has('remember');

            if (Auth::guard('vendor')->attempt($request->only('email', 'password'), $remember)) {
                // Successful login
                $vendor->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                    'failed_login_attempts' => 0,
                    'lockout_time' => null,
                ]);

                return redirect()
                    ->route('vendor.dashboard')
                    ->with('success', 'Welcome back, ' . $vendor->name . '!');
            } else {
                // Failed login
                $vendor->increment('failed_login_attempts');

                if ($vendor->failed_login_attempts >= $maxAttempts) {
                    $vendor->update([
                        'lockout_time' => now()->addMinutes($lockoutMinutes),
                        'failed_login_attempts' => 0,
                    ]);

                    return back()->withErrors(['email' => "Account locked due to too many failed attempts. Try again in {$lockoutMinutes} minutes."]);
                }

                $remaining = $maxAttempts - $vendor->failed_login_attempts;

                return back()->withErrors(['email' => "Invalid credentials. {$remaining} attempts remaining."]);
            }

        } else {
            return back()->withErrors(['email' => 'No vendor found with that email.']);
        }
    }



    /**
     * --------------------------
     * REGISTRATION
     * --------------------------
     */
    public function showRegistrationForm()
    {
        if (setting('vendor_registration_enabled') == 0) {
            return redirect()->route('vendor.login')
                ->with('error', 'Registration temporarily off');
        }
        return view('backend.vendor.auth.registration');
    }

    public function registration(Request $request)
    {
        if (setting('vendor_registration_enabled') == 0) {
            return redirect()->route('vendor.login')
                ->with('error', 'Registration temporarily off');
        }

        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100|unique:vendors,email',
            'password' => 'required|string|min:6|confirmed',
            'checkbox' => 'required',
        ]);
        $name = $request->name;
        $baseUsername = strtolower(str_replace(' ', '.', $name));
        $slugname = strtolower(str_replace(' ', '-', $name));
        $username = $baseUsername . rand(10000, 99999);
        $slug = $slugname . rand(10000, 99999);

        $vendorData = [
            'name' => $request->name,
            'username' => $username,
            'slug' => $slug,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (setting('email_verification') != 1) {
            $vendorData['email_verified_at'] = now();
        }

        $vendor = Vendor::create($vendorData);

        Auth::guard('vendor')->login($vendor);

        if (setting('email_verification') == 1) {
            $verification_link = route('vendor.verify', [
                'id' => $vendor->id,
                'token' => sha1($vendor->email)
            ]);

            $mailData = \App\Services\MailTemplateService::prepare('Email Verification', [
                'name' => $vendor->name,
                'site_name' => setting('site_name'),
                'email' => $vendor->email,
                'verification_link' => $verification_link,
            ]);

            Mail::to($vendor->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

            return redirect()->route('vendor.dashboard')
                ->with('success', 'Welcome, ' . $vendor->name . '! Please verify your email.');
        }

        // No verification → already verified
        return redirect()->route('vendor.dashboard')
            ->with('success', 'Welcome, ' . $vendor->name . '!');
    }


    /**
     * --------------------------
     * LOGOUT
     * --------------------------
     */
    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login')->with('success', 'You have been logged out.');
    }

    /**
     * --------------------------
     * FORGOT PASSWORD
     * --------------------------
     */
    public function showForgotPasswordForm()
    {
        return view('backend.vendor.auth.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $vendor = Vendor::where('email', $request->email)->first();

        if (!$vendor) {
            return back()->withErrors(['email' => 'No vendor found with that email.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->where('email', $request->email)->delete();

        // insert new token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'guard' => 'vendor',
            'created_at' => now(),
        ]);

        $resetLink = URL::temporarySignedRoute(
            'vendor.resetPassword',
            now()->addMinutes(60),
            [
                'token' => $token,
                'email' => $vendor->email,
                'guard' => 'vendor'
            ]
        );
        $mailData = \App\Services\MailTemplateService::prepare('Password Reset', [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'reset_link' => $resetLink,
        ]);

        Mail::to($vendor->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return back()->with('success', 'Password reset link has been sent to your email.');
    }

    /**
     * --------------------------
     * RESET PASSWORD
     * --------------------------
     */
    public function showResetPasswordForm(Request $request)
    {
        return view('backend.vendor.auth.reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('guard', 'vendor')
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        $vendor = Vendor::where('email', $request->email)->first();
        $vendor->update([
            'password' => Hash::make($request->password),
            'last_password_change' =>now()
        ]);

        // delete token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('vendor.login')->with('success', 'Password reset successfully!');
    }

    public function verify($id, $token)
    {
        $vendor = Vendor::find($id);
        if (! $vendor) {
            return redirect()->route('vendor.login')
                ->with('error', 'Invalid verification link.');
        }


        if ($token !== sha1($vendor->email)) {
            return redirect()->route('vendor.login')
                ->with('error', 'Invalid or expired verification link.');
        }

        if ($vendor->email_verified_at) {
            return redirect()->route('vendor.dashboard')
                ->with('success', 'Your email is already verified.');
        }

        $vendor->email_verified_at = now();
        $vendor->save();

        Auth::guard('vendor')->login($vendor);

        return redirect()->route('vendor.dashboard')
            ->with('success', 'Your email has been verified successfully!');
    }

    public function resend(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        if (!$vendor) {
            return redirect()->route('vendor.login')
                ->with('error', 'You must be logged in to resend verification.');
        }

        if ($vendor->email_verified_at) {
            return redirect()->route('vendor.dashboard')
                ->with('success', 'Your email is already verified.');
        }

        $verification_link = route('vendor.verify', [
            'id' => $vendor->id,
            'token' => sha1($vendor->email)
        ]);
        $mailData = \App\Services\MailTemplateService::prepare('Email Verification', [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'verification_link' => $verification_link,
        ]);

        Mail::to($vendor->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return redirect()->back()->with('success', 'Verification email resent successfully!');
    }

    public function unverified()
    {
        $vendor = Auth::guard('vendor')->user();
        if ($vendor->email_verified_at) {
            return redirect()->route('vendor.dashboard')
                ->with('success', 'Your email is already verified.');
        }
        return view('backend.vendor.unverified.unverified');
    }
}
