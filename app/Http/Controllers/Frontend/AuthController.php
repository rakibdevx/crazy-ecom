<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;
use URL;
use Mail;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();
        if ($user) {
            $maxAttempts = (int) setting('max_login_attempts');
            $lockoutMinutes = (int) setting('lockout_time');

            if ($user->lockout_time && now()->lessThan($user->lockout_time)) {
                $minutes = now()->diffInMinutes($user->lockout_time);
                return back()->withErrors(['email' => "Account locked. Try again in {$minutes} minutes."]);
            }

            if ($user->status != "active") {
                return back()->withErrors(['email' => "Your account has been {$user->status}. Please contact support for assistance."]);
            }

            $remember = $request->has('remember');

            if (Auth::guard('user')->attempt($request->only('email', 'password'), $remember)) {
                if($user->two_factor_enabled == 1)
                {
                    $code = rand(100000, 999999);
                    $expires_time = (int) setting('two_factor_expires_time');
                    $user->update([
                        'two_factor_secret' => $code,
                        'two_factor_expires_at' => now()->addMinutes($expires_time),
                    ]);
                    $mailData = \App\Services\MailTemplateService::prepare('Two Step Verification', [
                        'time' => $expires_time,
                        'name' => $user->name,
                        'site_name' => setting('site_name'),
                        'email' => $user->email,
                        'verification_code' => $code,
                    ]);

                    Mail::to($user->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));
                    Auth::guard('user')->logout();
                    return redirect()->route('user.otp', Crypt::encryptString($user->email));
                }
                $user->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                    'failed_login_attempts' => 0,
                    'lockout_time' => null,
                ]);

                return redirect()
                    ->route('index')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            } else {
                // Failed login
                $user->increment('failed_login_attempts');

                if ($user->failed_login_attempts >= $maxAttempts) {
                    $user->update([
                        'lockout_time' => now()->addMinutes($lockoutMinutes),
                        'failed_login_attempts' => 0,
                    ]);

                    return back()->withErrors(['email' => "Account locked due to too many failed attempts. Try again in {$lockoutMinutes} minutes."]);
                }

                $remaining = $maxAttempts - $user->failed_login_attempts;

                return back()->withErrors(['email' => "Invalid credentials. {$remaining} attempts remaining."]);
            }

        } else {
            return back()->withErrors(['email' => 'No user found with that email.']);
        }
    }



    /**
     * --------------------------
     * REGISTRATION
     * --------------------------
     */
    public function showRegistrationForm()
    {
        if (setting('user_registration_enabled') == 0) {
            return redirect()->route('user.login')
                ->with('error', 'Registration temporarily off');
        }
        return view('frontend.auth.registration');
    }

    public function registration(Request $request)
    {
        if (setting('user_registration_enabled') == 0) {
            return redirect()->route('user.login')
                ->with('error', 'Registration temporarily off');
        }

        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'checkbox' => 'required',
        ]);
        $name = $request->name;
        $baseUsername = strtolower(str_replace(' ', '.', $name));
        $slugname = strtolower(str_replace(' ', '-', $name));
        $username = $baseUsername . rand(10000, 99999);
        $slug = $slugname . rand(10000, 99999);

        $userData = [
            'name' => $request->name,
            'username' => $username,
            'slug' => $slug,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => setting('vendor_default_status') == 1?'active':'pending',
        ];

        if (setting('email_verification') != 1) {
            $userData['email_verified_at'] = now();
        }

        $user = User::create($userData);

        if ($user->status != "active") {
            return redirect()->route('login')->withErrors([
                'email' => "Your account is pending approval. Please verify your email and wait for confirmation."
            ]);
        }

        Auth::guard('user')->login($user);

        if (setting('email_verification') == 1) {
            $verification_link = route('user.verify', [
                'id' => $user->id,
                'token' => sha1($user->email)
            ]);

            $mailData = \App\Services\MailTemplateService::prepare('Email Verification', [
                'name' => $user->name,
                'site_name' => setting('site_name'),
                'email' => $user->email,
                'verification_link' => $verification_link,
            ]);

            Mail::to($user->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

            return redirect()->route('user.dashboard')
                ->with('success', 'Welcome, ' . $user->name . '! Please verify your email.');
        }

        // No verification → already verified
        return redirect()->route('user.dashboard')
            ->with('success', 'Welcome, ' . $user->name . '!');
    }


    /**
     * --------------------------
     * LOGOUT
     * --------------------------
     */
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with('success', 'You have been logged out.');
    }

    /**
     * --------------------------
     * FORGOT PASSWORD
     * --------------------------
     */
    public function showForgotPasswordForm()
    {
        return view('backend.user.auth.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = user::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with that email.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->where('email', $request->email)->delete();

        // insert new token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'guard' => 'user',
            'created_at' => now(),
        ]);

        $resetLink = URL::temporarySignedRoute(
            'user.resetPassword',
            now()->addMinutes(60),
            [
                'token' => $token,
                'email' => $user->email,
                'guard' => 'user'
            ]
        );
        $mailData = \App\Services\MailTemplateService::prepare('Password Reset', [
            'name' => $user->name,
            'email' => $user->email,
            'reset_link' => $resetLink,
        ]);

        Mail::to($user->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return back()->with('success', 'Password reset link has been sent to your email.');
    }

    /**
     * --------------------------
     * RESET PASSWORD
     * --------------------------
     */
    public function showResetPasswordForm(Request $request)
    {
        return view('backend.user.auth.reset', [
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
            ->where('guard', 'user')
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        $user = user::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
            'last_password_change' =>now()
        ]);

        // delete token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('user.login')->with('success', 'Password reset successfully!');
    }

    public function verify($id, $token)
    {
        $user = user::find($id);
        if (! $user) {
            return redirect()->route('user.login')
                ->with('error', 'Invalid verification link.');
        }


        if ($token !== sha1($user->email)) {
            return redirect()->route('user.login')
                ->with('error', 'Invalid or expired verification link.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard')
                ->with('success', 'Your email is already verified.');
        }

        $user->email_verified_at = now();
        $user->save();

        Auth::guard('user')->login($user);

        return redirect()->route('user.dashboard')
            ->with('success', 'Your email has been verified successfully!');
    }

    public function resend(Request $request)
    {
        $user = Auth::guard('user')->user();

        if (!$user) {
            return redirect()->route('user.login')
                ->with('error', 'You must be logged in to resend verification.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard')
                ->with('success', 'Your email is already verified.');
        }

        $verification_link = route('user.verify', [
            'id' => $user->id,
            'token' => sha1($user->email)
        ]);
        $mailData = \App\Services\MailTemplateService::prepare('Email Verification', [
            'name' => $user->name,
            'email' => $user->email,
            'verification_link' => $verification_link,
        ]);

        Mail::to($user->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return redirect()->back()->with('success', 'Verification email resent successfully!');
    }

    public function unverified()
    {
        $user = Auth::guard('user')->user();
        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard')
                ->with('success', 'Your email is already verified.');
        }
        return view('backend.user.unverified.unverified');
    }

    public function otp($email)
    {
        return view('backend.user.auth.otp',compact('email'));
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

        $user = user::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found for this email.']);
        }

        if (!$user->two_factor_secret || $user->two_factor_secret != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid verification code.']);
        }

        if (Carbon::parse($user->two_factor_expires_at)->isPast()) {
            return back()->withErrors(['otp' => 'Your verification code has expired. Please request a new one.']);
        }

        $user->two_factor_secret = null;
        $user->two_factor_expires_at = null;
        $user->last_login_at =  now();
        $user->last_login_ip =  $request->ip();
        $user->failed_login_attempts =  0;
        $user->lockout_time =  null;
        $user->save();

        auth('user')->login($user);

        return redirect()->route('user.dashboard')->with('success', 'Your identity has been verified successfully!');
    }

    public function resendOtp($email)
    {
        try {
            $decryptedEmail = Crypt::decryptString($email);
        } catch (\Exception $e) {
            return redirect()->route('user.login')->withErrors(['email' => 'Invalid verification link.']);
        }

        $user = user::where('email', $decryptedEmail)->first();
        if (!$user) {
            return redirect()->route('user.login')->withErrors(['email' => 'Account not found.']);
        }

        $code = rand(100000, 999999);
        $expires_time = (int) setting('two_factor_expires_time');
        $user->two_factor_secret = $code;
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        $mailData = \App\Services\MailTemplateService::prepare('Two Step Verification', [
            'time' => $expires_time,
            'name' => $user->name,
            'site_name' => setting('site_name'),
            'email' => $user->email,
            'verification_code' => $code,
        ]);

        Mail::to($user->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return back()->with('success', 'A new verification code has been sent to your email.');
    }

}
