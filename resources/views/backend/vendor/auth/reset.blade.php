@extends('backend.admin.auth.layout')
@push('title')
Reset Password
@endpush
@section('body')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">

    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent">
        <div class="card-body">
        <img src="{{asset(setting('reset_background'))}}" class="img-fluid auth-img-cover-login" width="650" alt="">
        </div>
    </div>

</div>
<div class="col-12 col-xl-5 col-xxl-4 auth-cover-righ d-flex align-items-center justify-content-center">
    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none">
        <div class="card-body p-sm-5">
            <img id="logo" src="{{ asset(setting('site_logo')) }}" class="mb-4" width="145" alt="">
            <h4 class="fw-bold">Reset Password?</h4>
            <p class="mb-0">Reset the password To login Your account</p>


            <div class="form-body mt-4">
                <form class="row g-3" action="{{ route('vendor.resetPassword.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    {{-- Email --}}
                    <div class="col-12">
                        <label for="inputEmailAddress" class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="inputEmailAddress" placeholder="jhon@example.com"
                               value="{{ old('email')??$email }}">
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

                     <div class="col-12">
                        <label for="inputChooseConfirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" name="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="inputChooseConfirmPassword" placeholder="Enter Password Again">
                            <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                        </div>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @error('token')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
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
