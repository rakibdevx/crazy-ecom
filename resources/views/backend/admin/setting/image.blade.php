@extends('backend.layout.index')
@push('title')
    Image Setting
@endpush
@push('plugins')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
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
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Image Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6 col-xl-6 d-flex">
                <div class="card w-100 rounded-4">
                    <div class="card-header">
                        <h5>Update Images</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.setting.image.update') }}" method="POST" enctype="multipart/form-data"
                            @class([
                                'row g-3 needs-validation',
                                'was-validated' => $errors->any()
                            ])>

                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Login Background</label>
                                <input class="form-control @error('login_background') is-invalid @enderror" type="file" name="login_background" id="formFile"  @error('login_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('login_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('login_background')))
                                    <img src="{{asset(setting('login_background'))}}" height="100px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Registration Background</label>
                                <input class="form-control @error('registration_background') is-invalid @enderror" type="file" name="registration_background" id="formFile"  @error('registration_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('registration_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                            @if (!empty(setting('registration_background')))
                                    <img src="{{ asset(setting('registration_background')) }}" height="100px" width="auto" alt="{{ setting('site_name') }}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Forgot Background</label>
                                <input class="form-control  @error('forgot_background') is-invalid @enderror" type="file" name="forgot_background" id="formFile" @error('forgot_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('forgot_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('forgot_background')))
                                    <img src="{{asset(setting('forgot_background'))}}" height="100px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Reset Background</label>
                                <input class="form-control  @error('reset_background') is-invalid @enderror" type="file" name="reset_background" id="formFile" @error('reset_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('reset_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('reset_background')))
                                    <img src="{{asset(setting('reset_background'))}}" height="100px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default profile Image</label>
                                <input class="form-control  @error('default_profile_image') is-invalid @enderror" type="file" name="default_profile_image" id="formFile" @error('default_profile_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_profile_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_profile_image')))
                                    <img src="{{asset(setting('default_profile_image'))}}" height="100px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default Product Image</label>
                                <input class="form-control  @error('default_product_image') is-invalid @enderror" type="file" name="default_product_image" id="formFile" @error('default_product_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_product_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_product_image')))
                                    <img src="{{asset(setting('default_product_image'))}}" height="100px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                <a href="{{route('admin.dashboard')}}" class="btn btn-primary px-5 raised">back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
@endsection

