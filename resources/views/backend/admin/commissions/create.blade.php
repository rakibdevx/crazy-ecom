@extends('backend.layout.index')
@push('title')
    Commission
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Commission</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.commission.index') }}">Commission</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.commission.index') }}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-8 col-xl-8 d-flex">
            <div class="row">
                <div class="col-md-12">
                    <div class="card w-100 rounded-4">
                        <div class="card-header">
                            <h5>Create New Commission</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.commission.store') }}" method="POST" class="row g-3 needs-validation">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Name:</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Commission Name" required>
                                    <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type:</label>
                                    <select name="type" id="type_select" class="form-control @error('type') is-invalid @enderror" required>
                                        <option value="global" {{ old('type')=='global'?'selected':'' }}>Global</option>
                                        <option value="category" {{ old('type')=='category'?'selected':'' }}>Category</option>
                                        <option value="subcategory" {{ old('type')=='subcategory'?'selected':'' }}>Subcategory</option>
                                        <option value="seller" {{ old('type')=='seller'?'selected':'' }}>Seller</option>
                                        <option value="product" {{ old('type')=='product'?'selected':'' }}>Product</option>
                                        <option value="custom" {{ old('type')=='custom'?'selected':'' }}>Custom Type</option>
                                    </select>
                                    <div class="invalid-feedback">@error('type') {{ $message }} @enderror</div>
                                </div>

                                <div class="mb-3" id="custom_type_div" style="display: none;">
                                    <label class="form-label">Custom Type:</label>
                                    <input type="text" name="custom_type" value="{{ old('custom_type') }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rate:</label>
                                    <input type="number" name="rate" step="0.01" value="{{ old('rate') }}"
                                        class="form-control @error('rate') is-invalid @enderror"
                                        placeholder="Enter Rate" required>
                                    <div class="invalid-feedback">@error('rate') {{ $message }} @enderror</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rate Type:</label>
                                    <select name="rate_type" class="form-control @error('rate_type') is-invalid @enderror" required>
                                        <option value="percentage" {{ old('rate_type')=='percentage'?'selected':'' }}>Percentage</option>
                                        <option value="flat" {{ old('rate_type')=='flat'?'selected':'' }}>Flat</option>
                                    </select>
                                    <div class="invalid-feedback">@error('rate_type') {{ $message }} @enderror</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Start Date:</label>
                                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                                        class="form-control @error('start_date') is-invalid @enderror">
                                    <div class="invalid-feedback">@error('start_date') {{ $message }} @enderror</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">End Date:</label>
                                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                                        class="form-control @error('end_date') is-invalid @enderror">
                                    <div class="invalid-feedback">@error('end_date') {{ $message }} @enderror</div>
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status:</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">@error('status') {{ $message }} @enderror</div>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success px-5 raised">Create</button>
                                    <a href="{{ route('admin.commission.index') }}" class="btn btn-primary px-5 raised">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const typeSelect = document.getElementById('type_select');
        const customDiv = document.getElementById('custom_type_div');

        typeSelect.addEventListener('change', function(){
            customDiv.style.display = this.value === 'custom' ? 'block' : 'none';
        });

        if(typeSelect.value === 'custom') customDiv.style.display = 'block';
    </script>

</div>
@endsection
