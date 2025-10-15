<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;
use Mail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            $maxAttempts = (int) setting('max_login_attempts');
            $lockoutMinutes = (int) setting('lockout_time');

            // Check if account is locked
            if ($admin->lockout_time && now()->lessThan($admin->lockout_time)) {
                $minutes = ceil(now()->diffInMinutes($admin->lockout_time));
                return back()->withErrors(['email' => "Account locked. Try again in {$minutes} minutes."]);
            }

            $remember = $request->has('remember');

            if (Auth::guard('admin')->attempt($request->only('email', 'password'), $remember)) {
                if($admin->two_factor_enabled == 1)
                {
                    $code = rand(100000, 999999);
                    $expires_time = (int) setting('two_factor_expires_time');
                    $admin->update([
                        'two_factor_secret' => $code,
                        'two_factor_expires_at' => now()->addMinutes($expires_time),
                    ]);
                    $mailData = \App\Services\MailTemplateService::prepare('Two Step Verification', [
                        'time' => $expires_time, 
                        'name' => $admin->name,
                        'site_name' => setting('site_name'),
                        'email' => $admin->email,
                        'verification_code' => $code,
                    ]);

                    Mail::to($admin->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.otp', Crypt::encryptString($admin->email));
                }

                $admin->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                    'failed_login_attempts' => 0,
                    'lockout_time' => null,
                ]);

                return redirect()
                    ->route('admin.dashboard')
                    ->with('success', 'Welcome back, ' . $admin->name . '!');
            } else {

                $admin->increment('failed_login_attempts');

                if ($admin->failed_login_attempts >= $maxAttempts) {
                    $admin->update([
                        'lockout_time' => now()->addMinutes($lockoutMinutes),
                        'failed_login_attempts' => 0,
                    ]);

                    return back()->withErrors(['email' => "Account locked due to too many failed attempts. Try again in {$lockoutMinutes} minutes."]);
                }

                $remaining = $maxAttempts - $admin->failed_login_attempts;
                return back()->withErrors(['email' => "Invalid credentials. {$remaining} attempts remaining."]);
            }
        } else {
            return back()->withErrors(['email' => 'No admin found with that email.']);
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }


     public function otp($email)
    {
        return view('backend.admin.auth.otp',compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'otp' => 'required|digits:6',
        ]);

        try {
            $email = Crypt::decryptString($request->email);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Invalid or expired verification link.']);
        }

        $admin = Admin::where('email', $email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'No account found for this email.']);
        }

        if (!$admin->two_factor_secret || $admin->two_factor_secret != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid verification code.']);
        }

        if (Carbon::parse($admin->two_factor_expires_at)->isPast()) {
            return back()->withErrors(['otp' => 'Your verification code has expired. Please request a new one.']);
        }

        $admin->two_factor_secret = null;
        $admin->two_factor_expires_at = null;
        $admin->last_login_at =  now();
        $admin->last_login_ip =  $request->ip();
        $admin->failed_login_attempts =  0;
        $admin->lockout_time =  null;
        $admin->save();

        auth('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Your identity has been verified successfully!');
    }

    public function resendOtp($email)
    {
        try {
            $decryptedEmail = Crypt::decryptString($email);
        } catch (\Exception $e) {
            return redirect()->route('admin.login')->withErrors(['email' => 'Invalid verification link.']);
        }

        $admin = Admin::where('email', $decryptedEmail)->first();
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['email' => 'Account not found.']);
        }

        $code = rand(100000, 999999);
        $expires_time = (int) setting('two_factor_expires_time');
        $admin->two_factor_secret = $code;
        $admin->two_factor_expires_at = now()->addMinutes($expires_time);
        $admin->save();

        $mailData = \App\Services\MailTemplateService::prepare('Two Step Verification', [
            'time' => $expires_time,
            'name' => $admin->name,
            'site_name' => setting('site_name'),
            'email' => $admin->email,
            'verification_code' => $code,
        ]);

        Mail::to($admin->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return back()->with('success', 'A new verification code has been sent to your email.');
    }


}
