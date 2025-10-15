 @extends('backend.layout.index')
@push('title')
    Create Permission
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Create Permission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.permission.index')}}">Permission</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.permission.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
                </div>
            </div>
        </div>

    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Create New Permission</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.permission.store') }}" method="POST"
                            class="row g-3 needs-validation">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name"
                                    value="{{ old('name')}}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Name" required>
                                <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success px-5 raised">Create</button>
                                <a href="{{ route('admin.permission.index') }}" class="btn btn-primary px-5 raised">Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
