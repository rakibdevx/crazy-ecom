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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
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
                                <label for="formFile" class="form-label">Login Background (<small class="text-danger">Dimensions must be 2000 x 2000 pixels</small>)</label>
                                <input class="form-control @error('login_background') is-invalid @enderror" type="file" name="login_background" id="formFile"  @error('login_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('login_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('login_background')))
                                    <img src="{{asset(setting('login_background'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Registration Background (<small class="text-danger">Dimensions must be 2000 x 2000 pixels</small>)</label>
                                <input class="form-control @error('registration_background') is-invalid @enderror" type="file" name="registration_background" id="formFile"  @error('registration_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('registration_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                            @if (!empty(setting('registration_background')))
                                    <img src="{{ asset(setting('registration_background')) }}" class= "max-width-300 max-height-100" width="auto" alt="{{ setting('site_name') }}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Forgot Background (<small class="text-danger">Dimensions must be 2000 x 2000 pixels</small>)</label>
                                <input class="form-control  @error('forgot_background') is-invalid @enderror" type="file" name="forgot_background" id="formFile" @error('forgot_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('forgot_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('forgot_background')))
                                    <img src="{{asset(setting('forgot_background'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Reset Background (<small class="text-danger">Dimensions must be 2000 x 2000 pixels</small>)</label>
                                <input class="form-control  @error('reset_background') is-invalid @enderror" type="file" name="reset_background" id="formFile" @error('reset_background') required @enderror>
                                <div class="invalid-feedback">
                                    @error('reset_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('reset_background')))
                                    <img src="{{asset(setting('reset_background'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default profile Image (<small class="text-danger">Dimensions must be 250 x 250 pixels</small>)</label>
                                <input class="form-control  @error('default_profile_image') is-invalid @enderror" type="file" name="default_profile_image" id="formFile" @error('default_profile_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_profile_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_profile_image')))
                                    <img src="{{asset(setting('default_profile_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default profile Banner (<small class="text-danger">Dimensions must be 600 x 1100 pixels</small>)</label>
                                <input class="form-control  @error('default_profile_banner') is-invalid @enderror" type="file" name="default_profile_banner" id="formFile" @error('default_profile_banner') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_profile_banner')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_profile_banner')))
                                    <img src="{{asset(setting('default_profile_banner'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default Product Image (<small class="text-danger">Dimensions must be 800 x 650 pixels</small>)</label>
                                <input class="form-control  @error('default_product_image') is-invalid @enderror" type="file" name="default_product_image" id="formFile" @error('default_product_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_product_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_product_image')))
                                    <img src="{{asset(setting('default_product_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default Category Image (<small class="text-danger">Dimensions must be 150 x 150 pixels</small>)</label>
                                <input class="form-control  @error('default_category_image') is-invalid @enderror" type="file" name="default_category_image" id="formFile" @error('default_category_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_category_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_category_image')))
                                    <img src="{{asset(setting('default_category_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default Sub Category Image (<small class="text-danger">Dimensions must be 150 x 150 pixels</small>)</label>
                                <input class="form-control  @error('default_sub_category_image') is-invalid @enderror" type="file" name="default_sub_category_image" id="formFile" @error('default_sub_category_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_sub_category_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_sub_category_image')))
                                    <img src="{{asset(setting('default_sub_category_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default Brand Image (<small class="text-danger">Dimensions must be 100 x 250 pixels</small>)</label>
                                <input class="form-control  @error('default_brand_image') is-invalid @enderror" type="file" name="default_brand_image" id="formFile" @error('default_brand_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_brand_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_brand_image')))
                                    <img src="{{asset(setting('default_brand_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Default Slider Image (<small class="text-danger">Dimensions must be 700 x 480 pixels</small>)</label>
                                <input class="form-control  @error('default_slider_image') is-invalid @enderror" type="file" name="default_slider_image" id="formFile" @error('default_slider_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('default_slider_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('default_slider_image')))
                                    <img src="{{asset(setting('default_slider_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Footer Payment Image (<small class="text-danger">Dimensions must be 300 x 20 pixels</small>)</label>
                                <input class="form-control  @error('footer_payment_image') is-invalid @enderror" type="file" name="footer_payment_image" id="formFile" @error('footer_payment_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('footer_payment_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('footer_payment_image')))
                                    <img src="{{asset(setting('footer_payment_image'))}}" class= "max-width-300 max-height-100" width="auto" alt="{{setting('site_name')}}">
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

