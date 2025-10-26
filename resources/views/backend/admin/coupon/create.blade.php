@extends('backend.layout.index')
@push('title')
    Create Coupon
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Coupons</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.coupon.index') }}">Coupons</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i> Back</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-4">
                <div class="card-header">
                    <h5>Create New Coupon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupon.store') }}" method="POST" class="row g-3 needs-validation">
                        @csrf

                        <!-- Coupon Code -->
                        <div class="mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Coupon Code" required>
                            <div class="invalid-feedback">@error('code') {{ $message }} @enderror</div>
                        </div>

                        <!-- Discount Type -->
                        <div class="mb-3">
                            <label class="form-label">Discount Type</label>
                            <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror" required>
                                <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            <div class="invalid-feedback">@error('discount_type') {{ $message }} @enderror</div>
                        </div>

                        <!-- Discount Amount -->
                        <div class="mb-3">
                            <label class="form-label">Discount Amount</label>
                            <input type="number" step="0.01" name="discount_amount" value="{{ old('discount_amount') }}" class="form-control @error('discount_amount') is-invalid @enderror" placeholder="Enter Discount Amount" required>
                            <div class="invalid-feedback">@error('discount_amount') {{ $message }} @enderror</div>
                        </div>

                        <!-- Max & Min Amount -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Max Discount Amount (optional)</label>
                                <input type="number" step="0.01" name="max_discount_amount" value="{{ old('max_discount_amount') }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Minimum Order Amount (optional)</label>
                                <input type="number" step="0.01" name="min_order_amount" value="{{ old('min_order_amount') }}" class="form-control">
                            </div>
                        </div>

                        <!-- Validity Dates -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Valid From</label>
                                <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror" required>
                                <div class="invalid-feedback">@error('start_date') {{ $message }} @enderror</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Valid Until</label>
                                <input type="datetime-local" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror" required>
                                <div class="invalid-feedback">@error('end_date') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <!-- Category / Sub / Child / Brand -->
                        <div class="mb-3">
                            <label class="form-label">Category / Sub / Child / Brand (optional)</label>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <select name="category_id" id="category" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="sub_category_id" id="sub_category" class="form-control select2">
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="child_category_id" id="child_category" class="form-control select2">
                                        <option value="">Select Child Category</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="brand_id" class="form-control select2">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Specific User & Products -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Specific User (optional)</label>
                                <select name="specific_user_id" class="form-control select2">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Specific Products (optional)</label>
                                <select name="applicable_products[]" class="form-control select2" multiple>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Usage Limits & Auto Apply -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Usage Limit Per Coupon (optional)</label>
                                <input type="number" name="usage_limit_per_coupon" class="form-control" value="{{ old('usage_limit_per_coupon') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Usage Limit Per User (optional)</label>
                                <input type="number" name="usage_limit_per_user" class="form-control" value="{{ old('usage_limit_per_user') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Auto Apply?</label>
                                <select name="is_auto_apply" class="form-control">
                                    <option value="0" {{ old('is_auto_apply') == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('is_auto_apply') == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label class="form-label">Notes (optional)</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success px-5">Create</button>
                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary px-5">Back</a>
                        </div>

                    </form>
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
$(document).ready(function() {
    $('.select2').select2({ theme: "bootstrap-5" });

    // Dependent dropdowns
    $('#category').on('change', function() {
        let categoryId = $(this).val();
        $('#sub_category').html('<option value="">Select Sub Category</option>');
        $('#child_category').html('<option value="">Select Child Category</option>');
        if(categoryId){
            $.ajax({
                url: '{{ route("admin.coupon.getSubcategories", ":id") }}'.replace(':id', categoryId),
                type: 'GET',
                success: function(data){
                    data.forEach(function(sub){
                        $('#sub_category').append('<option value="'+sub.id+'">'+sub.name+'</option>');
                    });
                }
            });
        }
    });

    $('#sub_category').on('change', function() {
        let subCategoryId = $(this).val();
        $('#child_category').html('<option value="">Select Child Category</option>');
        if(subCategoryId){
            $.ajax({
                url: '{{ route("admin.coupon.getChildCategories", ":id") }}'.replace(':id', subCategoryId),
                type: 'GET',
                success: function(data){
                    data.forEach(function(child){
                        $('#child_category').append('<option value="'+child.id+'">'+child.name+'</option>');
                    });
                }
            });
        }
    });
});
</script>
@endpush
