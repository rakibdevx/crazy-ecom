@extends('backend.admin.auth.layout')
@push('title')
Login
@endpush
@section('body')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">

    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent">
        <div class="card-body">
        <img src="{{asset(setting('login_background'))}}" class="img-fluid auth-img-cover-login" width="650" alt="">
        </div>
    </div>

</div>
<div class="col-12 col-xl-5 col-xxl-4 auth-cover-righ d-flex align-items-center justify-content-center">
    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none">
        <div class="card-body p-sm-5">
            <img id="logo" src="{{ asset(setting('site_logo')) }}" class="mb-4" width="145" alt="">
            <h4 class="fw-bold">Get Started Now</h4>
            <p class="mb-0">Enter your credentials to login your account</p>

            {{-- General Errors --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="form-body mt-4">
                <form class="row g-3" action="{{ route('vendor.login.submit') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <div class="col-12">
                        <label for="inputEmailAddress" class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="inputEmailAddress" placeholder="jhon@example.com"
                               value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="inputChoosePassword" placeholder="Enter Password">
                            <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="remember" type="checkbox"
                                   id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">	<a href="{{route('vendor.forgot')}}">Forgot Password ?</a>
                    </div>
                    @if(setting('vendor_registration_enabled') == 1)
                        <div class="col-12">
                            <div class="text-start">
                                <p class="mb-0">Don't have an account yet? <a href="{{route('vendor.registration')}}">Sign up here</a>
                                </p>
                            </div>
                        </div>
                    @endif
                    {{-- Submit --}}
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
