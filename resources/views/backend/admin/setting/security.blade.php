@extends('backend.layout.index')
@push('title')
    Security Settings
@endpush

@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Setting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Security Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-md-6 col-xl-6 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Update Security Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.security.update') }}" method="POST"
                        class="row g-3 needs-validation @if($errors->any()) was-validated @endif">
                        @csrf

                        <!-- Max Login Attempts -->
                        <div class="mb-3">
                            <label class="form-label">Max Login Attempts:</label>
                            <input type="number" name="max_login_attempts" value="{{ old('max_login_attempts', setting('max_login_attempts')) }}" class="form-control @error('max_login_attempts') is-invalid @enderror" placeholder="e.g. 5" @error('max_login_attempts') required @enderror>
                            <div class="invalid-feedback">@error('max_login_attempts') {{ $message }} @enderror</div>
                        </div>

                        <!-- Lockout Time -->
                        <div class="mb-3">
                            <label class="form-label">Lockout Time (minutes):</label>
                            <input type="number" name="lockout_time" value="{{ old('lockout_time', setting('lockout_time')) }}" class="form-control @error('lockout_time') is-invalid @enderror" placeholder="e.g. 15" @error('lockout_time') required @enderror>
                            <div class="invalid-feedback">@error('lockout_time') {{ $message }} @enderror</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Two Step Code Expires Time (minutes):</label>
                            <input type="number" name="two_factor_expires_time" value="{{ old('two_factor_expires_time', setting('two_factor_expires_time')) }}" class="form-control @error('two_factor_expires_time') is-invalid @enderror" placeholder="e.g. 15" @error('two_factor_expires_time') required @enderror>
                            <div class="invalid-feedback">@error('two_factor_expires_time') {{ $message }} @enderror</div>
                        </div>

                        <!-- reCAPTCHA Enabled -->
                        <div class="mb-3">
                            <label class="form-label">reCAPTCHA Enabled:</label>
                            <select name="recaptcha_enabled" class="form-control @error('recaptcha_enabled') is-invalid @enderror" @error('recaptcha_enabled') required @enderror>
                                <option value="1" {{ old('recaptcha_enabled', setting('recaptcha_enabled')) == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ old('recaptcha_enabled', setting('recaptcha_enabled')) == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                            <div class="invalid-feedback">@error('recaptcha_enabled') {{ $message }} @enderror</div>
                        </div>

                        <!-- reCAPTCHA Site Key -->
                        <div class="mb-3">
                            <label class="form-label">reCAPTCHA Site Key:</label>
                            <input type="text" name="recaptcha_site_key" value="{{ old('recaptcha_site_key', setting('recaptcha_site_key')) }}" class="form-control @error('recaptcha_site_key') is-invalid @enderror" placeholder="Site Key" @error('recaptcha_site_key') required @enderror>
                            <div class="invalid-feedback">@error('recaptcha_site_key') {{ $message }} @enderror</div>
                        </div>

                        <!-- reCAPTCHA Secret Key -->
                        <div class="mb-3">
                            <label class="form-label">reCAPTCHA Secret Key:</label>
                            <input type="text" name="recaptcha_secret_key" value="{{ old('recaptcha_secret_key', setting('recaptcha_secret_key')) }}" class="form-control @error('recaptcha_secret_key') is-invalid @enderror" placeholder="Secret Key" @error('recaptcha_secret_key') required @enderror>
                            <div class="invalid-feedback">@error('recaptcha_secret_key') {{ $message }} @enderror</div>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Update</button>
                            <a href="{{route('admin.dashboard')}}" class="btn btn-primary px-5 raised">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
