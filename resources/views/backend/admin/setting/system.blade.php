@extends('backend.layout.index')
@push('title')
    System Settings
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Setting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">System Settings</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-6 col-xl-6 d-flex">
        <div class="card w-100 rounded-4">
            <div class="card-header">
                <h5>Update System Settings</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.setting.system.update') }}" method="POST"
                    class="row g-3 needs-validation @if($errors->any()) was-validated @endif">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Maintenance Mode:</label>
                        <select name="maintenance_mode" class="form-control @error('maintenance_mode') is-invalid @enderror" @error('maintenance_mode') required @enderror>
                            <option value="1" {{ old('maintenance_mode', setting('maintenance_mode')) == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('maintenance_mode', setting('maintenance_mode')) == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                        <div class="invalid-feedback">@error('maintenance_mode') {{ $message }} @enderror</div>
                    </div>

                    <!-- Registration Enabled -->
                    <div class="mb-3">
                        <label class="form-label">Registration Enabled:</label>
                        <select name="registration_enabled" class="form-control @error('registration_enabled') is-invalid @enderror" @error('registration_enabled') required @enderror>
                            <option value="1" {{ old('registration_enabled', setting('registration_enabled')) == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('registration_enabled', setting('registration_enabled')) == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                        <div class="invalid-feedback">@error('registration_enabled') {{ $message }} @enderror</div>
                    </div>

                    <!-- Email Verification -->
                    <div class="mb-3">
                        <label class="form-label">Email Verification:</label>
                        <select name="email_verification" class="form-control @error('email_verification') is-invalid @enderror" @error('email_verification') required @enderror>
                            <option value="1" {{ old('email_verification', setting('email_verification')) == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('email_verification', setting('email_verification')) == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                        <div class="invalid-feedback">@error('email_verification') {{ $message }} @enderror</div>
                    </div>

                    <!-- Two Factor Auth -->
                    <div class="mb-3">
                        <label class="form-label">Two Factor Auth:</label>
                        <select name="two_factor_auth" class="form-control @error('two_factor_auth') is-invalid @enderror" @error('two_factor_auth') required @enderror>
                            <option value="1" {{ old('two_factor_auth', setting('two_factor_auth')) == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('two_factor_auth', setting('two_factor_auth')) == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                        <div class="invalid-feedback">@error('two_factor_auth') {{ $message }} @enderror</div>
                    </div>

                    <!-- Currency -->
                    <div class="mb-3">
                        <label class="form-label">Currency:</label>
                        <input type="text" name="currency" value="{{ old('currency', setting('currency')) }}" class="form-control @error('currency') is-invalid @enderror" placeholder="e.g. USD" @error('currency') required @enderror>
                        <div class="invalid-feedback">@error('currency') {{ $message }} @enderror</div>
                    </div>

                    <!-- Currency Symbol -->
                    <div class="mb-3">
                        <label class="form-label">Currency Symbol:</label>
                        <input type="text" name="currency_symbol" value="{{ old('currency_symbol', setting('currency_symbol')) }}" class="form-control @error('currency_symbol') is-invalid @enderror" placeholder="e.g. $" @error('currency_symbol') required @enderror>
                        <div class="invalid-feedback">@error('currency_symbol') {{ $message }} @enderror</div>
                    </div>

                    <!-- Date Format -->
                    <div class="mb-3">
                        <label class="form-label">Date Format:</label>
                        <input type="text" name="date_format" value="{{ old('date_format', setting('date_format')) }}" class="form-control @error('date_format') is-invalid @enderror" placeholder="e.g. d-m-Y" @error('date_format') required @enderror>
                        <div class="invalid-feedback">@error('date_format') {{ $message }} @enderror</div>
                    </div>

                    <!-- Time Format -->
                    <div class="mb-3">
                        <label class="form-label">Time Format:</label>
                        <input type="text" name="time_format" value="{{ old('time_format', setting('time_format')) }}" class="form-control @error('time_format') is-invalid @enderror" placeholder="e.g. H:i" @error('time_format') required @enderror>
                        <div class="invalid-feedback">@error('time_format') {{ $message }} @enderror</div>
                    </div>

                    <!-- Default Pagination -->
                    <div class="mb-3">
                        <label class="form-label">Default Pagination:</label>
                        <input type="number" name="default_pagination" value="{{ old('default_pagination', setting('default_pagination')) }}" class="form-control @error('default_pagination') is-invalid @enderror" placeholder="e.g. 10" @error('default_pagination') required @enderror>
                        <div class="invalid-feedback">@error('default_pagination') {{ $message }} @enderror</div>
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
@endsection
