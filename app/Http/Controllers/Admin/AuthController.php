<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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
                // Successful login

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
}
