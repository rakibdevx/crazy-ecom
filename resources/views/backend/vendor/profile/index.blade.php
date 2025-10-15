@extends('backend.layout.index')
@push('title')
    Profile
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6 col-xl-6 d-flex">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Profile Update</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.update') }}" method="POST"
                                    class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Name:</label>
                                        <input type="text" name="name"
                                            value="{{ old('name', auth()->guard('vendor')->user()->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name" required>
                                        <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email:</label>
                                        <input type="email" name="email"
                                            value="{{ old('email', auth()->guard('vendor')->user()->email) }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Email" required>
                                        <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone:</label>
                                        <input type="text" name="phone"
                                            value="{{ old('phone', auth()->guard('vendor')->user()->phone) }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter Phone" >
                                        <div class="invalid-feedback">@error('phone') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Bio:</label>
                                        <textarea name="bio" rows="3"
                                            class="form-control @error('bio') is-invalid @enderror"
                                            placeholder="Write something about yourself..." >{{ old('bio', auth()->guard('vendor')->user()->bio) }}</textarea>
                                        <div class="invalid-feedback">@error('bio') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Two Factor Authentication:</label>
                                        <select name="two_factor_enabled"
                                            class="form-control @error('two_factor_enabled') is-invalid @enderror" required>
                                            <option value="0" {{ old('two_factor_enabled', auth()->guard('vendor')->user()->two_factor_enabled) == 0 ? 'selected' : '' }}>Disabled</option>
                                            <option value="1" {{ old('two_factor_enabled', auth()->guard('vendor')->user()->two_factor_enabled) == 1 ? 'selected' : '' }}>Enabled</option>
                                        </select>
                                        <div class="invalid-feedback">@error('two_factor_enabled') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Notification Preferences:</label>
                                        <select name="notification_preferences"
                                            class="form-control @error('notification_preferences') is-invalid @enderror" required>
                                            <option value="0" {{ old('notification_preferences', auth()->guard('vendor')->user()->notification_preferences) == 0 ? 'selected' : '' }}>Disabled</option>
                                            <option value="1" {{ old('notification_preferences', auth()->guard('vendor')->user()->notification_preferences) == 1 ? 'selected' : '' }}>Enabled</option>
                                        </select>
                                        <div class="invalid-feedback">@error('notification_preferences') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                        <a href="{{ route('vendor.dashboard') }}" class="btn btn-primary px-5 raised">Back</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card rounded-4">
                            <div class="card-header">
                                <h5>Change Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.changePassword') }}" method="POST" class="needs-validation" novalidate>
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Current Password:</label>
                                        <input type="password" name="current_password"
                                            class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter Current Password" required>
                                        <div class="invalid-feedback">@error('current_password') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password:</label>
                                        <input type="password" name="new_password"
                                            class="form-control @error('new_password') is-invalid @enderror" placeholder="Enter New Password" required>
                                        <div class="invalid-feedback">@error('new_password') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password:</label>
                                        <input type="password" name="new_password_confirmation"
                                            class="form-control" placeholder="Confirm New Password" required>
                                    </div>

                                    <button type="submit" class="btn btn-warning px-5 raised text-white">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Business Information</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.business') }}" method="POST" class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Company Name:</label>
                                        <input type="text" name="company_name" value="{{ old('company_name', auth()->guard('vendor')->user()->company_name) }}"
                                            class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter Company Name" required>
                                        <div class="invalid-feedback">@error('company_name') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Company Website:</label>
                                        <input type="url" name="company_website" value="{{ old('company_website', auth()->guard('vendor')->user()->company_website) }}"
                                            class="form-control @error('company_website') is-invalid @enderror" placeholder="https://example.com">
                                        <div class="invalid-feedback">@error('company_website') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address:</label>
                                        <input type="text" name="address" value="{{ old('address', auth()->guard('vendor')->user()->address) }}"
                                            class="form-control @error('address') is-invalid @enderror" placeholder="Enter Address">
                                        <div class="invalid-feedback">@error('address') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">City:</label>
                                            <input type="text" name="city" value="{{ old('city', auth()->guard('vendor')->user()->city) }}"
                                                class="form-control @error('city') is-invalid @enderror" placeholder="City">
                                            <div class="invalid-feedback">@error('city') {{ $message }} @enderror</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">State:</label>
                                            <input type="text" name="state" value="{{ old('state', auth()->guard('vendor')->user()->state) }}"
                                                class="form-control @error('state') is-invalid @enderror" placeholder="State">
                                            <div class="invalid-feedback">@error('state') {{ $message }} @enderror</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Country:</label>
                                            <input type="text" name="country" value="{{ old('country', auth()->guard('vendor')->user()->country) }}"
                                                class="form-control @error('country') is-invalid @enderror" placeholder="Country">
                                            <div class="invalid-feedback">@error('country') {{ $message }} @enderror</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Postal Code:</label>
                                            <input type="text" name="postal_code" value="{{ old('postal_code', auth()->guard('vendor')->user()->postal_code) }}"
                                                class="form-control @error('postal_code') is-invalid @enderror" placeholder="Postal Code">
                                            <div class="invalid-feedback">@error('postal_code') {{ $message }} @enderror</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Business Type:</label>
                                        <input type="text" name="business_type" value="{{ old('business_type', auth()->guard('vendor')->user()->business_type) }}"
                                            class="form-control @error('business_type') is-invalid @enderror" placeholder="e.g., Retail, Services">
                                        <div class="invalid-feedback">@error('business_type') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Business Description:</label>
                                        <textarea name="business_description" rows="4"
                                                class="form-control @error('business_description') is-invalid @enderror"
                                                placeholder="Describe your business...">{{ old('business_description', auth()->guard('vendor')->user()->business_description) }}</textarea>
                                        <div class="invalid-feedback">@error('business_description') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                        <a href="{{ route('vendor.dashboard') }}" class="btn btn-primary px-5 raised">Back</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Important Information</h5>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @if(auth()->guard('vendor')->user()->last_login_at)
                                        <li>Last login Time : {{format_date(auth()->guard('vendor')->user()->last_login_at) }} ({{ format_time(auth()->guard('vendor')->user()->last_login_at) }})</li>
                                    @endif
                                    @if(auth()->guard('vendor')->user()->last_login_ip)
                                        <li>Last login Ip : {{auth()->guard('vendor')->user()->last_login_ip}}</li>
                                    @endif
                                    @if(auth()->guard('vendor')->user()->failed_login_attempts)
                                        <li>Failed Login Attempts : {{auth()->guard('vendor')->user()->failed_login_attempts}}</li>
                                    @endif
                                    @if(auth()->guard('vendor')->user()->lockout_time)
                                        @php
                                            $lockout = auth()->guard('vendor')->user()->lockout_time;
                                            $now = now();
                                            $remaining = $lockout->greaterThan($now) ? $lockout->diffForHumans($now, true) : '0 minutes';
                                        @endphp
                                        <li>Login Lock: {{ $remaining }}</li>
                                    @endif

                                        <li>Two Factor : {{auth()->guard('vendor')->user()->two_factor_enabled==1? 'Enable':'Disable'}}</li>

                                    @if(auth()->guard('vendor')->user()->two_factor_secret)
                                        <li>Two Factor Secret : Yes</li>
                                    @endif
                                    @if(auth()->guard('vendor')->user()->last_password_change)
                                        <li>Last Password Change : {{ \Carbon\Carbon::parse(auth()->guard('vendor')->user()->last_password_change)->diffForHumans() }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Profile Image</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.image') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Image:</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                        @if(auth()->guard('vendor')->user()->profile_image)
                                            <img height="200px" src="{{asset(auth()->guard('vendor')->user()->profile_image)}}" alt="{{auth()->guard('vendor')->user()->name}}">
                                        @endif
                                    </div>

                                     <div class="mb-3">
                                        <label class="form-label">Banner Image:</label>
                                        <input type="file" name="banner_image"
                                            class="form-control @error('banner_image') is-invalid @enderror">
                                        <div class="invalid-feedback">@error('banner_image') {{ $message }} @enderror</div>
                                        @if(auth()->guard('vendor')->user()->banner_image)
                                            <img height="200px" src="{{asset(auth()->guard('vendor')->user()->banner_image)}}" alt="{{auth()->guard('vendor')->user()->name}}">
                                        @endif
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Social Media Links</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.social') }}" method="POST" class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Facebook URL:</label>
                                        <input type="url" name="facebook" value="{{ old('facebook', auth()->guard('vendor')->user()->facebook) }}"
                                            class="form-control @error('facebook') is-invalid @enderror" placeholder="https://facebook.com/yourpage">
                                        <div class="invalid-feedback">@error('facebook') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Twitter URL:</label>
                                        <input type="url" name="twitter" value="{{ old('twitter', auth()->guard('vendor')->user()->twitter) }}"
                                            class="form-control @error('twitter') is-invalid @enderror" placeholder="https://twitter.com/yourhandle">
                                        <div class="invalid-feedback">@error('twitter') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Instagram URL:</label>
                                        <input type="url" name="instagram" value="{{ old('instagram', auth()->guard('vendor')->user()->instagram) }}"
                                            class="form-control @error('instagram') is-invalid @enderror" placeholder="https://instagram.com/yourhandle">
                                        <div class="invalid-feedback">@error('instagram') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">LinkedIn URL:</label>
                                        <input type="url" name="linkedin" value="{{ old('linkedin', auth()->guard('vendor')->user()->linkedin) }}"
                                            class="form-control @error('linkedin') is-invalid @enderror" placeholder="https://linkedin.com/in/yourprofile">
                                        <div class="invalid-feedback">@error('linkedin') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">YouTube URL:</label>
                                        <input type="url" name="youtube" value="{{ old('youtube', auth()->guard('vendor')->user()->youtube) }}"
                                            class="form-control @error('youtube') is-invalid @enderror" placeholder="https://youtube.com/yourchannel">
                                        <div class="invalid-feedback">@error('youtube') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
