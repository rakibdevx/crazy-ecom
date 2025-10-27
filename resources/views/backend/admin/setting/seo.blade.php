@extends('backend.layout.index')
@push('title')
    Seo Setting
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
                        <li class="breadcrumb-item active" aria-current="page">Seo Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6 col-xl-6 d-flex">
                <div class="card w-100 rounded-4">
                    <div class="card-header">
                        <h5>Update Seo Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.setting.seo.update') }}" method="POST" enctype="multipart/form-data"
                            @class([
                                'row g-3 needs-validation',
                                'was-validated' => $errors->any()
                            ])>

                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Meta Title:</label>
                                <input type="text" name="meta_title" value="{{ old('meta_title', setting('meta_title')) }}" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Meta Title"  @error('meta_title') required @enderror>
                                <div class="invalid-feedback">
                                    @error('meta_title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta  Description:</label>
                                <textarea name="meta_description" class="form-control  @error('meta_description') is-invalid @enderror" placeholder="Meta Description" rows="1"  @error('meta_description') required @enderror>{{ old('meta_description', setting('meta_description')) }}</textarea>
                                <div class="invalid-feedback">
                                    @error('meta_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Keywords:</label>
                                <input type="text" value="{{ old('meta_keywords', setting('meta_keywords')) }}" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Meta Keywords" @error('meta_keywords') required @enderror>
                                <div class="invalid-feedback">
                                    @error('meta_keywords')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Title:</label>
                                <input type="text" value="{{ old('og_title', setting('og_title')) }}" name="og_title" class="form-control @error('og_title') is-invalid @enderror" placeholder="Meta Keywords" @error('og_title') required @enderror>
                                <div class="invalid-feedback">
                                    @error('og_title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">OG Description:</label>
                                <textarea name="og_description" class="form-control  @error('og_description') is-invalid @enderror" placeholder="Meta Description" rows="1"  @error('og_description') required @enderror>{{ old('og_description', setting('og_description')) }}</textarea>
                                <div class="invalid-feedback">
                                    @error('og_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">OG Image (<small class="text-danger">Dimensions must be 800 x 650 pixels</small>)</label>
                                <input class="form-control @error('og_image') is-invalid @enderror" type="file" name="og_image" id="formFile"  @error('og_image') required @enderror>
                                <div class="invalid-feedback">
                                    @error('og_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                                @if (!empty(setting('og_image')))
                                    <img src="{{asset(setting('og_image'))}}" height="40px" width="auto" alt="{{setting('site_name')}}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Twitter Card (<small class="text-danger">Dimensions must be 800 x 650 pixels</small>)</label>
                                <input class="form-control @error('twitter_card') is-invalid @enderror" type="file" name="twitter_card" id="formFile"  @error('twitter_card') required @enderror>
                                <div class="invalid-feedback">
                                    @error('twitter_card')
                                        {{ $message }}
                                    @enderror
                                </div>
                            @if (!empty(setting('twitter_card')))
                                    <img src="{{ asset(setting('twitter_card')) }}" height="40px" width="auto" alt="{{ setting('site_name') }}">
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

