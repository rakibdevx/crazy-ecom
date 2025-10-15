<?php

namespace App\Http\Controllers\Vendor;

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
        return view('backend.vendor.profile.index');
    }

    public function update(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        $phoneDigitMin = setting('phone_digit_min') ?? 6;
        $phoneDigitMax = setting('phone_digit_max') ?? 15;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:vendors,email,' . $vendor->id,
            'phone' => [
                'required',
                'regex:/^[0-9]+$/',
                'min:' . $phoneDigitMin,
                'max:' . $phoneDigitMax,
            ],
            'bio' => 'nullable|string|max:1000',
            'two_factor_enabled' => 'required|boolean',
            'notification_preferences' => 'required|boolean',
        ]);
        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'two_factor_enabled' => $request->two_factor_enabled,
            'notification_preferences' => $request->notification_preferences,
        ]);
        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $vendor->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $vendor->update([
            'password' => Hash::make($request->new_password),
            'last_password_change' => now(),
        ]);


        if($vendor->notification_preferences == 1)
        {
            $mailData = \App\Services\MailTemplateService::prepare('Password Changed', [
                'name' => $vendor->name,
                'site_name' => setting('site_name'),
                'support_email' => setting('support_email'),
            ]);

            Mail::to($vendor->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));
        }
        return back()->with('success', 'Password updated successfully!');

    }

    public function image(Request $request)
    {
        $request->validate([
            'image'=> ['nullable', 'file', new ValidImage()],
            'banner_image'=> ['nullable', 'file', new ValidImage()],
        ]);
        $vendor = Auth::guard('vendor')->user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($vendor->profile_image) {
                $oldPath = public_path($vendor->profile_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'image' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/vendor/profiles'), $filename);
            $vendor->update([
                'profile_image'=> 'backend/images/vendor/profiles/' . $filename
            ]);
        }
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            if ($vendor->banner_image) {
                $oldPath = public_path($vendor->banner_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'banner_image' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/vendor/banners'), $filename);
            $vendor->update([
                'banner_image'=> 'backend/images/vendor/banners/' . $filename
            ]);
        }
        return back()->with('success', 'Image updated successfully!');
    }

     public function updateBusiness(Request $request)
    {
        $vendor = auth()->guard('vendor')->user();

        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'business_type' => 'nullable|string|max:100',
            'business_description' => 'nullable|string|max:1000',
        ]);

        $vendor->update([
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'business_type' => $request->business_type,
            'business_description' => $request->business_description,
        ]);

        return back()->with('success', 'Business information updated successfully!');
    }

    public function updateSocial(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        $request->validate([
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        $vendor->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
        ]);

        return back()->with('success', 'Social media links updated successfully!');
    }
}

