@extends('backend.admin.auth.layout')
@push('title')
Sent Reset Link
@endpush
@section('body')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">

    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent">
        <div class="card-body">
        <img src="{{asset(setting('forgot_background'))}}" class="img-fluid auth-img-cover-login" width="650" alt="">
        </div>
    </div>

</div>
<div class="col-12 col-xl-5 col-xxl-4 auth-cover-righ d-flex align-items-center justify-content-center">
    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none">
        <div class="card-body p-sm-5">
            <img id="logo" src="{{ asset(setting('site_logo')) }}" class="mb-4" width="145" alt="">
            <h4 class="fw-bold">Forgot Password?</h4>
            <p class="mb-0">Enter your registered email ID to reset the password</p>

            {{-- General Errors --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="form-body mt-4">
                <form class="row g-3" action="{{ route('vendor.forgot.submit') }}" method="POST">
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


                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Send</button>
                            <a href="{{route('vendor.login')}}" class="btn btn-light">Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
