<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\ValidImage;
use Mail;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.admin.profile.index');
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $phoneDigitMin = setting('phone_digit_min') ?? 6;
        $phoneDigitMax = setting('phone_digit_max') ?? 15;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
            'phone' => [
                'required',
                'regex:/^[0-9]+$/',
                'min:' . $phoneDigitMin,
                'max:' . $phoneDigitMax,
            ],

            'bio' => 'nullable|string|max:1000',
            'two_factor_enabled' => 'required|boolean',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'two_factor_enabled' => $request->two_factor_enabled,
        ]);
        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
            'last_password_change' => now(),
        ]);

        $mailData = \App\Services\MailTemplateService::prepare('Password Changed', [
            'name' => $admin->name,
            'site_name' => setting('site_name'),
            'support_email' => setting('support_email'),
        ]);

        Mail::to($admin->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return back()->with('success', 'Password updated successfully!');
    }

    public function image(Request $request)
    {
        $request->validate([
            'image'=> ['nullable', 'file', new ValidImage()],
            'banner_image'=> ['nullable', 'file', new ValidImage()],
        ]);
        $admin = Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($admin->profile_image) {
                $oldPath = public_path($admin->profile_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'image' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/admin/profiles'), $filename);
            $admin->update([
                'profile_image'=> 'backend/images/admin/profiles/' . $filename
            ]);
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            if ($admin->banner_image) {
                $oldPath = public_path($admin->banner_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'banner_image' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/admin/banners'), $filename);
            $admin->update([
                'banner_image'=> 'backend/images/admin/banners/' . $filename
            ]);
        }
        return back()->with('success', 'Image updated successfully!');
    }
}
