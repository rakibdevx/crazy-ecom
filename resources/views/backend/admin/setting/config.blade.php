@extends('backend.layout.index')
@push('title')
    Image & Phone Config
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
                    <li class="breadcrumb-item active" aria-current="page">Support & Phone Config</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="col-6 col-xl-6 d-flex">
        <div class="card w-100 rounded-4">
            <div class="card-header">
                <h5>Update Image & Phone Config</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.setting.config.update') }}" method="POST"
                    class="row g-3 needs-validation @if($errors->any()) was-validated @endif">
                    @csrf

                    <!-- Support Image Type -->
                    <div class="mb-3">
                        <label class="form-label">Support Image Type <small>(extensions comma separated and must from png,jpg,jpeg,gif,bmp,svg,webp,tiff,ico,heic,avif)</small>:</label>
                        <input type="text" name="support_image_type" value="{{ old('support_image_type', setting('support_image_type')) }}" class="form-control @error('support_image_type') is-invalid @enderror" placeholder="png,jpg,jpeg,gif" @error('support_image_type') required @enderror>
                        <div class="invalid-feedback">@error('support_image_type') {{ $message }} @enderror</div>
                    </div>

                    <!-- Support Image Max Size -->
                    <div class="mb-3">
                        <label class="form-label">Support Image Max Size (KB):</label>
                        <input type="number" name="support_image_max" value="{{ old('support_image_max', setting('support_image_max')) }}" class="form-control @error('support_image_max') is-invalid @enderror" placeholder="2048" @error('support_image_max') required @enderror>
                        <div class="invalid-feedback">@error('support_image_max') {{ $message }} @enderror</div>
                    </div>

                    <!-- Phone Digit Min -->
                    <div class="mb-3">
                        <label class="form-label">Phone Digit Min:</label>
                        <input type="number" name="phone_digit_min" value="{{ old('phone_digit_min', setting('phone_digit_min')) }}" class="form-control @error('phone_digit_min') is-invalid @enderror" placeholder="9" @error('phone_digit_min') required @enderror>
                        <div class="invalid-feedback">@error('phone_digit_min') {{ $message }} @enderror</div>
                    </div>

                    <!-- Phone Digit Max -->
                    <div class="mb-3">
                        <label class="form-label">Phone Digit Max:</label>
                        <input type="number" name="phone_digit_max" value="{{ old('phone_digit_max', setting('phone_digit_max')) }}" class="form-control @error('phone_digit_max') is-invalid @enderror" placeholder="11" @error('phone_digit_max') required @enderror>
                        <div class="invalid-feedback">@error('phone_digit_max') {{ $message }} @enderror</div>
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
