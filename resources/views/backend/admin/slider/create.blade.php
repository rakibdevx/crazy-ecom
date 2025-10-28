@extends('backend.layout.index')

@push('title')
    Create Slider
@endpush

@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Slider</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary px-4">
                    <i class="bx bx-left-arrow-circle"></i> Back
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-8 col-xl-8 d-flex">
            <div class="row w-100">
                <div class="col-md-12">
                    <div class="card w-100 rounded-4">
                        <div class="card-header">
                            <h5>Create New Slider</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                                @csrf

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Title:</label>
                                    <input type="text" name="title"
                                        value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter Title">
                                    <div class="invalid-feedback">@error('title') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Subtitle:</label>
                                    <input type="text" name="subtitle"
                                        value="{{ old('subtitle') }}"
                                        class="form-control @error('subtitle') is-invalid @enderror"
                                        placeholder="Enter Subtitle">
                                    <div class="invalid-feedback">@error('subtitle') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Details:</label>
                                    <textarea type="text" name="details"
                                        class="form-control @error('details') is-invalid @enderror"
                                        placeholder="Enter details">{{ old('details') }}</textarea>
                                    <div class="invalid-feedback">@error('details') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button Text:</label>
                                    <input type="text" name="button_text"
                                        value="{{ old('button_text', 'Learn More') }}"
                                        class="form-control @error('button_text') is-invalid @enderror"
                                        placeholder="Enter Button Text">
                                    <div class="invalid-feedback">@error('button_text') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button Link:</label>
                                    <input type="url" name="link"
                                        value="{{ old('link') }}"
                                        class="form-control @error('link') is-invalid @enderror"
                                        placeholder="https://example.com">
                                    <div class="invalid-feedback">@error('link') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Image: (<small class="text-danger">Dimensions must be 700 x 480 pixels</small>)</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status:</label>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ old('status', 'active') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', 'inactive') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sort Order:</label>
                                    <input type="number" name="sort_order"
                                        value="{{ old('sort_order', 0) }}"
                                        class="form-control @error('sort_order') is-invalid @enderror"
                                        placeholder="Enter Sort Order">
                                    <div class="invalid-feedback">@error('sort_order') {{ $message }} @enderror</div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success px-5 raised">Create</button>
                                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary px-5 raised">Back</a>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
