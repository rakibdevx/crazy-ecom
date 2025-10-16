@extends('backend.layout.index')
@push('title')
    {{$child_category->name}}
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Child Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.child_category.index') }}">Child Category</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$child_category->name}}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.child_category.index') }}" class="btn btn-primary px-4">
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
                            <h5>Edit Child Category</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.child_category.update',$child_category->id) }}" method="POST"
                                class="row g-3 needs-validation">
                                @csrf
                                @method('put')
                                {{-- Category Select --}}
                                <div class="mb-3">
                                    <label class="form-label">Select Category:</label>
                                    <select id="category" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">@error('category_id') {{ $message }} @enderror</div>
                                </div>

                                {{-- SubCategory Select --}}
                                <div class="mb-3">
                                    <label class="form-label">Select Sub Category:</label>
                                    <select id="subcategory" name="sub_category_id" class="form-control @error('sub_category_id') is-invalid @enderror" required>
                                        <option value="">-- Select Sub Category --</option>
                                    </select>
                                    <div class="invalid-feedback">@error('sub_category_id') {{ $message }} @enderror</div>
                                </div>

                                {{-- Name --}}
                                <div class="mb-3">
                                    <label class="form-label">Name:</label>
                                    <input type="text" name="name"
                                        value="{{ $child_category->name }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Child Category Name" required>
                                    <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Status:</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="active" {{ $child_category->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $child_category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">@error('status') {{ $message }} @enderror</div>
                                </div>

                                <div class="col">
                                    <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                    <a href="{{ route('admin.child_category.index') }}" class="btn btn-primary px-5 raised">Back</a>
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

        $('#category, #subcategory').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: "Select an option"
        });

        var oldCategory = {{ $child_category->subcategory->category_id ?? 'null' }};
        var oldSubCategory = {{ $child_category->sub_categories_id ?? 'null' }};

        function loadSubCategories(category_id, selected_id = null) {
            $('#subcategory').html('<option value="">Loading...</option>');

            if (category_id) {
                $.ajax({
                    url: "{{ route('admin.getSubCategories') }}",
                    type: "GET",
                    data: { category_id: category_id },
                    success: function(data) {
                        $('#subcategory').empty().append('<option value="">-- Select Sub Category --</option>');
                        $.each(data, function(key, value) {
                            var selected = (value.id == selected_id) ? 'selected' : '';
                            $('#subcategory').append('<option value="'+ value.id +'" '+selected+'>'+ value.name +'</option>');
                        });
                        $('#subcategory').trigger('change');
                    },
                    error: function() {
                        $('#subcategory').html('<option value="">Error loading</option>');
                    }
                });
            } else {
                $('#subcategory').html('<option value="">-- Select Sub Category --</option>');
            }
        }

        // On category change
        $('#category').on('change', function() {
            var cat_id = $(this).val();
            loadSubCategories(cat_id);
        });

        // Trigger on page load if old values exist
        if(oldCategory) {
            $('#category').val(oldCategory).trigger('change');
            loadSubCategories(oldCategory, oldSubCategory);
        }
    });
</script>
@endpush
