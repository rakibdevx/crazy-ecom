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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
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
                                <form action="{{ route('admin.profile.update') }}" method="POST"
                                    class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Name:</label>
                                        <input type="text" name="name"
                                            value="{{ old('name', auth()->guard('admin')->user()->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name" required>
                                        <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email:</label>
                                        <input type="email" name="email"
                                            value="{{ old('email', auth()->guard('admin')->user()->email) }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Email" required>
                                        <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone:</label>
                                        <input type="text" name="phone"
                                            value="{{ old('phone', auth()->guard('admin')->user()->phone) }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter Phone" >
                                        <div class="invalid-feedback">@error('phone') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Bio:</label>
                                        <textarea name="bio" rows="3"
                                            class="form-control @error('bio') is-invalid @enderror"
                                            placeholder="Write something about yourself..." >{{ old('bio', auth()->guard('admin')->user()->bio) }}</textarea>
                                        <div class="invalid-feedback">@error('bio') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Two Factor Authentication:</label>
                                        <select name="two_factor_enabled"
                                            class="form-control @error('two_factor_enabled') is-invalid @enderror" required>
                                            <option value="0" {{ old('two_factor_enabled', auth()->guard('admin')->user()->two_factor_enabled) == 0 ? 'selected' : '' }}>Disabled</option>
                                            <option value="1" {{ old('two_factor_enabled', auth()->guard('admin')->user()->two_factor_enabled) == 1 ? 'selected' : '' }}>Enabled</option>
                                        </select>
                                        <div class="invalid-feedback">@error('two_factor_enabled') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary px-5 raised">Back</a>
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
                                <form action="{{ route('admin.profile.changePassword') }}" method="POST" class="needs-validation" novalidate>
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
                                    @if(auth()->guard('admin')->user()->last_login_at)
                                        <li>Last login Time : {{ \Carbon\Carbon::parse(auth()->guard('admin')->user()->last_login_at)->diffForHumans() }}</li>
                                    @endif
                                    @if(auth()->guard('admin')->user()->last_login_ip)
                                        <li>Last login Ip : {{auth()->guard('admin')->user()->last_login_ip}}</li>
                                    @endif
                                    @if(auth()->guard('admin')->user()->failed_login_attempts)
                                        <li>Failed Login Attempts : {{auth()->guard('admin')->user()->failed_login_attempts}}</li>
                                    @endif
                                    @if(auth()->guard('admin')->user()->lockout_time)
                                        @php
                                            $lockout = auth()->guard('admin')->user()->lockout_time;
                                            $now = now();
                                            $remaining = $lockout->greaterThan($now) ? $lockout->diffForHumans($now, true) : '0 minutes';
                                        @endphp
                                        <li>Login Lock: {{ $remaining }}</li>
                                    @endif

                                        <li>Two Factor : {{auth()->guard('admin')->user()->two_factor_enabled==1? 'Enable':'Disable'}}</li>

                                    @if(auth()->guard('admin')->user()->two_factor_secret)
                                        <li>Two Factor Secret : Yes</li>
                                    @endif
                                    @if(auth()->guard('admin')->user()->last_password_change)
                                        <li>Last Password Change : {{ \Carbon\Carbon::parse(auth()->guard('admin')->user()->last_password_change)->diffForHumans() }}</li>
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
                                <form action="{{ route('admin.profile.image') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Image:</label>
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror"required>
                                        <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                        @if(auth()->guard('admin')->user()->profile_image)
                                            <img src="{{asset(auth()->guard('admin')->user()->profile_image)}}" alt="{{auth()->guard('admin')->user()->name}}">
                                        @endif
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
