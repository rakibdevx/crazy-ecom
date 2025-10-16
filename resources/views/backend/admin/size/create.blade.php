@extends('backend.layout.index')

@push('title')
    Size
@endpush

@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Size</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.size.index') }}">Size</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.size.index') }}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i> Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-6 col-xl-6 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Create New Size</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.size.store') }}" method="POST" class="row g-3 needs-validation">
                        @csrf
                        <!-- Size Name -->
                        <div class="mb-3">
                            <label class="form-label">Size Name:</label>
                            <input type="text" name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter Size Name" required>
                            <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Save</button>
                            <a href="{{ route('admin.size.index') }}" class="btn btn-primary px-5 raised">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
