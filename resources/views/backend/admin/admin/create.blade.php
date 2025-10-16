@extends('backend.layout.index')
@push('title')
    Admin Crate
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.admin.index')}}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.admin.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
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
                                <h5>Create New Admin</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.admin.store') }}" method="POST"
                                    class="row g-3 needs-validation">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Name:</label>
                                        <input type="text" name="name"
                                            value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name" required>
                                        <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email:</label>
                                        <input type="email" name="email"
                                            value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Email" required>
                                        <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone:</label>
                                        <input type="text" name="phone"
                                            value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter Phone" >
                                        <div class="invalid-feedback">@error('phone') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password:</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter Current Password" required>
                                        <div class="invalid-feedback">@error('password') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Assign Role:</label>
                                        <select class="form-select @error('role') is-invalid @enderror"
                                                name="role[]"
                                                id="single-select-field"
                                                multiple
                                                data-placeholder="Choose one thing"
                                                required>
                                            <option value="">-- Select Role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ old('role') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('role')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Create</button>
                                        <a href="{{ route('admin.admin.index') }}" class="btn btn-primary px-5 raised">Back</a>
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
        $( '#single-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    })
</script>
@endpush
