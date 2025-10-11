@extends('backend.layout.index')
@push('title')
    Mail Settings
@endpush

@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Setting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mail Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="col-6 col-xl-6 d-flex">
        <div class="card w-100 rounded-4">
            <div class="card-header">
                <h5>Update Mail Settings</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.setting.mail.update') }}" method="POST" enctype="multipart/form-data"
                    @class([
                        'row g-3 needs-validation',
                        'was-validated' => $errors->any()
                    ])>

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Mail Mailer:</label>
                        <input type="text" name="mail_mailer" value="{{ old('mail_mailer', setting('mail_mailer')) }}"
                            class="form-control @error('mail_mailer') is-invalid @enderror"
                            placeholder="e.g. smtp" @error('mail_mailer') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_mailer') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail Host:</label>
                        <input type="text" name="mail_host" value="{{ old('mail_host', setting('mail_host')) }}"
                            class="form-control @error('mail_host') is-invalid @enderror"
                            placeholder="e.g. smtp.mailtrap.io" @error('mail_host') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_host') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail Port:</label>
                        <input type="number" name="mail_port" value="{{ old('mail_port', setting('mail_port')) }}"
                            class="form-control @error('mail_port') is-invalid @enderror"
                            placeholder="e.g. 587" @error('mail_port') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_port') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail Username:</label>
                        <input type="text" name="mail_username" value="{{ old('mail_username', setting('mail_username')) }}"
                            class="form-control @error('mail_username') is-invalid @enderror"
                            placeholder="Mail Username" @error('mail_username') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_username') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail Password:</label>
                        <input type="text" name="mail_password" value="{{ old('mail_password', setting('mail_password')) }}"
                            class="form-control @error('mail_password') is-invalid @enderror"
                            placeholder="Mail Password" @error('mail_password') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_password') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail Encryption:</label>
                        <input type="text" name="mail_encryption" value="{{ old('mail_encryption', setting('mail_encryption')) }}"
                            class="form-control @error('mail_encryption') is-invalid @enderror"
                            placeholder="tls / ssl" @error('mail_encryption') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_encryption') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail From Address:</label>
                        <input type="email" name="mail_from_address" value="{{ old('mail_from_address', setting('mail_from_address')) }}"
                            class="form-control @error('mail_from_address') is-invalid @enderror"
                            placeholder="example@mail.com" @error('mail_from_address') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_from_address') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mail From Name:</label>
                        <input type="text" name="mail_from_name" value="{{ old('mail_from_name', setting('mail_from_name')) }}"
                            class="form-control @error('mail_from_name') is-invalid @enderror"
                            placeholder="Your Name / Company Name" @error('mail_from_name') required @enderror>
                        <div class="invalid-feedback">
                            @error('mail_from_name') {{ $message }} @enderror
                        </div>
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
