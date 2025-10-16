@extends('backend.layout.index')
@push('title')
    Sub Category
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sub Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.sub_category.index') }}">Sub Category</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.sub_category.index') }}" class="btn btn-primary px-4">
                    <i class="bx bx-left-arrow-circle"></i> Back
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-6 col-xl-6 d-flex">
            <div class="row">
                <div class="col-md-12">
                    <div class="card w-100 rounded-4">
                        <div class="card-header">
                            <h5>Create New Sub Category</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sub_category.store') }}" method="POST" enctype="multipart/form-data"
                                class="row g-3 needs-validation">
                                @csrf

                                {{-- Category Select --}}
                                <div class="mb-3">
                                    <label class="form-label">Select Category:</label>
                                    <select id="select" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">@error('category_id') {{ $message }} @enderror</div>
                                </div>

                                {{-- Name --}}
                                <div class="mb-3">
                                    <label class="form-label">Name:</label>
                                    <input type="text" name="name"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Sub Category Name" required>
                                    <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status:</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>In active</option>
                                    </select>
                                    <div class="invalid-feedback">@error('status') {{ $message }} @enderror</div>
                                </div>

                                {{-- Image --}}
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="formFile">
                                    <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success px-5 raised">Create</button>
                                    <a href="{{ route('admin.sub_category.index') }}" class="btn btn-primary px-5 raised">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('plugins')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
    "use strict";
        $( '#select' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    })
</script>
@endpush
