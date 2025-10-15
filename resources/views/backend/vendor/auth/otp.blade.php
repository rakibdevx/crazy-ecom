@extends('backend.admin.auth.layout')
@push('title')
OTP Verification
@endpush

@section('body')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">
    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent">
        <div class="card-body">
            <img src="{{ asset(setting('reset_background')) }}" class="img-fluid auth-img-cover-login" width="650" alt="">
        </div>
    </div>
</div>

<div class="col-12 col-xl-5 col-xxl-4 auth-cover-righ d-flex align-items-center justify-content-center">
    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none">
        <div class="card-body p-sm-5">
            <img id="logo" src="{{ asset(setting('site_logo')) }}" class="mb-4" width="145" alt="">

            <h4 class="fw-bold mb-2">Two Step Verification</h4>
            <p class="mb-4 text-muted">We’ve sent a 6-digit verification code to your email. Please enter it below to verify your identity.</p>

            <div class="form-body">
                <form class="row g-3" action="{{ route('vendor.otp.verify') }}" method="POST">
                    @csrf
                    {{-- Hidden encrypted email --}}
                    <input type="hidden" name="email" value="{{ $email }}">

                    {{-- OTP Code --}}
                    <div class="col-12">
                        <label for="otp_code" class="form-label">Verification Code</label>
                        <input type="text" name="otp"
                               class="form-control text-center fw-bold fs-5 tracking-widest @error('otp') is-invalid @enderror"
                               id="otp_code" maxlength="6" placeholder="Enter 6-digit code">
                        @error('otp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('email')
                        <div class="invalid-feedback">Something Is Wrong With Email</div>
                        @enderror
                    </div>
                    {{-- Resend Link --}}
                    <div class="col-12 text-end">
                        <a href="{{ route('vendor.resendOtp',$email) }}" class="text-decoration-none small text-primary">Resend Code</a>
                    </div>

                    {{-- Submit --}}
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Verify</button>
                            <a href="{{ route('vendor.login') }}" class="btn btn-light">Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
