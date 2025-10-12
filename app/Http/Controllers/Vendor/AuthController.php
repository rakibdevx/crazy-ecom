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
        return view('backend.vendor.auth.registration');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|min:2',
            'email' => 'required|email|max:100|unique:vendors,email',
            'password' => 'required|string|min:6|confirmed',
            'checkbox' => 'required',
        ]);


        $vendor = Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('vendor')->login($vendor);

        return redirect()->route('vendor.dashboard')->with('success', 'Welcome, ' . $vendor->name . '!');
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

        // TODO: send $token via email (Mail::to($vendor->email)->send(...))
        $resetLink = URL::temporarySignedRoute(
            'vendor.resetPassword',
            now()->addMinutes(60),
            [
                'token' => $token,
                'email' => $vendor->email,
                'guard' => 'vendor'
            ]
        );
        return $resetLink;

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
            'password' => Hash::make($request->password)
        ]);

        // delete token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('vendor.login')->with('success', 'Password reset successfully!');
    }
}
