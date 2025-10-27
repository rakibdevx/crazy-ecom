@extends('backend.layout.index')
@push('title')
    General Setting
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
                        <li class="breadcrumb-item active" aria-current="page">General Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 d-flex">
                <div class="card w-100 rounded-4">
                    <div class="card-header">
                        <h5>Update Setting Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data"
                            @class([
                                'row g-3 needs-validation',
                                'was-validated' => $errors->any()
                            ])>

                            @csrf
                            <div class="mb-3">
                                <label class="form-label">System  Name:<small class="text-danger">If you update the name, then your software will be rebooted</small></label>
                                <input type="text" name="site_name" value="{{ old('site_name', setting('site_name')) }}" class="form-control @error('site_name') is-invalid @enderror" placeholder="System Name"  @error('site_name') required @enderror>
                                <div class="invalid-feedback">
                                    @error('site_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">System  Address:</label>
                                <input type="text" value="{{ old('address', setting('address')) }}" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="System  Address"  @error('address') required @enderror>
                                <div class="invalid-feedback">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">System  Timezone:</label>
                                <select class="form-select  @error('timezone') is-invalid @enderror" name="timezone" id="single-select-field" data-placeholder="Choose one thing" @error('timezone') required @enderror>
                                    @foreach ($time_zones as $time_zone)
                                        <option value="{{$time_zone->name}}" {{setting('timezone') == $time_zone->name?'selected':'' }}>{{$time_zone->name}}({{$time_zone->offset}})</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('timezone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">System  Description:</label>
                                <textarea name="site_description" class="form-control  @error('site_description') is-invalid @enderror" placeholder="System Description" rows="1"  @error('site_description') required @enderror>{{ old('site_description', setting('site_description')) }}</textarea>
                                <div class="invalid-feedback">
                                    @error('site_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Footer Text:</label>
                                <input type="text" value="{{ old('footer_text', setting('footer_text')) }}" name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" placeholder="Footer Text" @error('footer_text') required @enderror>
                                <div class="invalid-feedback">
                                    @error('footer_text')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Logo  (<small class="text-danger">Dimensions must be 250 x 100 pixels</small>)</label>
                                <input class="form-control @error('site_logo') is-invalid @enderror" type="file" name="site_logo" id="formFile"  @error('site_logo') required @enderror>
                                <div class="invalid-feedback">
                                    @error('site_logo')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('site_logo')))
                                    <img src="{{asset(setting('site_logo'))}}" height="40px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Dark Logo (<small class="text-danger">Dimensions must be 250 x 100 pixels</small>)</label>
                                <input class="form-control @error('site_logo_dark') is-invalid @enderror" type="file" name="site_logo_dark" id="formFile"  @error('site_logo_dark') required @enderror>
                                <div class="invalid-feedback">
                                    @error('site_logo_dark')
                                        {{ $message }}
                                    @enderror
                                </div>
                            @if (!empty(setting('site_logo_dark')))
                                    <img src="{{ asset(setting('site_logo_dark')) }}" height="40px" width="auto" alt="{{ setting('site_name') }}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Fav Icon (<small class="text-danger">Dimensions must be 32 x 32 pixels</small>)</label>
                                <input class="form-control  @error('site_favicon') is-invalid @enderror" type="file" name="site_favicon" id="formFile" @error('site_favicon') required @enderror>
                                <div class="invalid-feedback">
                                    @error('site_favicon')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('site_favicon')))
                                    <img src="{{asset(setting('site_favicon'))}}" height="40px" width="auto" alt="{{setting('site_name')}}">
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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
    "use strict";
        $( '#single-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    })
</script>
@endpush
