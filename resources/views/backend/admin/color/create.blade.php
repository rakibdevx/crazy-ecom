@extends('backend.layout.index')

@push('title')
    Color
@endpush

@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Color</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.color.index') }}">Color</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.color.index') }}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i> Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-6 col-xl-6 d-flex">
            <div class="card w-100 rounded-4">
                <div class="card-header">
                    <h5>Create New Color</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.color.store') }}" method="POST" class="row g-3 needs-validation">
                        @csrf

                        <!-- Color Name -->
                        <div class="mb-3">
                            <label class="form-label">Color Name:</label>
                            <input type="text" name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter Color Name" required>
                            <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                        </div>

                        <!-- Color Picker -->
                        <div class="mb-3">
                            <label class="form-label">Color Code:</label>
                            <div class="input-group">
                                <input type="color" name="code"
                                    value="{{ old('code', '#000000') }}"
                                    class="form-control form-control-color @error('code') is-invalid @enderror"
                                    id="colorPicker" title="Choose your color" required>
                                <input type="text" id="colorCode" name="code_text"
                                    class="form-control" readonly value="{{ old('code', '#000000') }}">
                            </div>
                            <div class="invalid-feedback">@error('code') {{ $message }} @enderror</div>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-success px-5 raised">Save</button>
                            <a href="{{ route('admin.color.index') }}" class="btn btn-primary px-5 raised">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional: Live color code update --}}
@push('js')
<script>
    const picker = document.getElementById('colorPicker');
    const codeInput = document.getElementById('colorCode');

    picker.addEventListener('input', () => {
        codeInput.value = picker.value;
    });
</script>
@endpush
@endsection
