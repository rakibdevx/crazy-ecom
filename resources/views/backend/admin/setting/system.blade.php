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
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">System Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-6 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Update System Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.system.update') }}" method="POST"
                        class="row g-3 needs-validation @if($errors->any()) was-validated @endif">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Maintenance Mode Front:</label>
                            <select name="front_maintenance_mode" class="form-control @error('front_maintenance_mode') is-invalid @enderror" @error('front_maintenance_mode') required @enderror>
                                <option value="1" {{ old('front_maintenance_mode', setting('front_maintenance_mode')) == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ old('front_maintenance_mode', setting('front_maintenance_mode')) == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                            <div class="invalid-feedback">@error('front_maintenance_mode') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Maintenance Mode Vendor:</label>
                            <select name="vendor_maintenance_mode" class="form-control @error('vendor_maintenance_mode') is-invalid @enderror" @error('vendor_maintenance_mode') required @enderror>
                                <option value="1" {{ old('vendor_maintenance_mode', setting('vendor_maintenance_mode')) == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ old('vendor_maintenance_mode', setting('vendor_maintenance_mode')) == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                            <div class="invalid-feedback">@error('vendor_maintenance_mode') {{ $message }} @enderror</div>
                        </div>

                        <!-- Registration Enabled -->
                        <div class="mb-3">
                            <label class="form-label">User Registration Enabled:</label>
                            <select name="user_registration_enabled" class="form-control @error('user_registration_enabled') is-invalid @enderror" @error('user_registration_enabled') required @enderror>
                                <option value="1" {{ old('user_registration_enabled', setting('user_registration_enabled')) == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ old('user_registration_enabled', setting('user_registration_enabled')) == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                            <div class="invalid-feedback">@error('user_registration_enabled') {{ $message }} @enderror</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User Default Status:</label>
                            <select name="user_default_status" class="form-control @error('user_default_status') is-invalid @enderror" @error('user_default_status') required @enderror>
                                <option value="1" {{ old('user_default_status', setting('user_default_status')) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('user_default_status', setting('user_default_status')) == 0 ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="invalid-feedback">@error('user_default_status') {{ $message }} @enderror</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vendor Registration Enabled:</label>
                            <select name="vendor_registration_enabled" class="form-control @error('vendor_registration_enabled') is-invalid @enderror" @error('vendor_registration_enabled') required @enderror>
                                <option value="1" {{ old('vendor_registration_enabled', setting('vendor_registration_enabled')) == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ old('vendor_registration_enabled', setting('vendor_registration_enabled')) == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                            <div class="invalid-feedback">@error('vendor_registration_enabled') {{ $message }} @enderror</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vendor Default Status:</label>
                            <select name="vendor_default_status" class="form-control @error('vendor_default_status') is-invalid @enderror" @error('vendor_default_status') required @enderror>
                                <option value="1" {{ old('vendor_default_status', setting('vendor_default_status')) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('vendor_default_status', setting('vendor_default_status')) == 0 ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="invalid-feedback">@error('vendor_default_status') {{ $message }} @enderror</div>
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
                            <label class="form-label">App Debug:</label>
                            <select name="app_debug" class="form-control @error('app_debug') is-invalid @enderror" @error('app_debug') required @enderror>
                                <option value="1" {{ old('app_debug', setting('app_debug')) == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ old('app_debug', setting('app_debug')) == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                            <div class="invalid-feedback">@error('app_debug') {{ $message }} @enderror</div>
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

                        <div class="mb-3">
                            <label class="form-label">Date Format:</label>
                            <select name="date_format"
                                    class="form-select @error('date_format') is-invalid @enderror"
                                    required>
                                @foreach($dateFormats as $format)
                                    <option value="{{ $format->format }}"
                                        {{ old('date_format', setting('date_format')) == $format->format ? 'selected' : '' }}>
                                        {{ $format->format }} - ({{ $format->example }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">@error('date_format') {{ $message }} @enderror</div>
                        </div>

                        <!-- Time Format -->
                        <div class="mb-3">
                            <label class="form-label">Time Format:</label>
                            <select name="time_format"
                                    class="form-select @error('time_format') is-invalid @enderror"
                                    required>
                                @foreach($timeFormats as $format)
                                    <option value="{{ $format->format }}"
                                        {{ old('time_format', setting('time_format')) == $format->format ? 'selected' : '' }}>
                                        {{ $format->format }} - ({{ $format->example }})
                                    </option>
                                @endforeach
                            </select>
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
</div>
@endsection
