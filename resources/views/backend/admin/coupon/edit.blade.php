@extends('backend.layout.index')
@push('title')
    Edit Coupon
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
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    <h5>Edit Coupon</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" name="code" value="{{ old('code', $coupon->code) }}" class="form-control @error('code') is-invalid @enderror" required>
                            <div class="invalid-feedback">@error('code') {{ $message }} @enderror</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Discount Type</label>
                            <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror" required>
                                <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percentage" {{ old('discount_type', $coupon->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            <div class="invalid-feedback">@error('discount_type') {{ $message }} @enderror</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Discount Amount</label>
                            <input type="number" step="0.01" name="discount_amount" value="{{ old('discount_amount', $coupon->discount_amount) }}" class="form-control @error('discount_amount') is-invalid @enderror" required>
                            <div class="invalid-feedback">@error('discount_amount') {{ $message }} @enderror</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Max Discount Amount (optional)</label>
                                <input type="number" step="0.01" name="max_discount_amount" value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}" class="form-control @error('max_discount_amount') is-invalid @enderror">
                                <div class="invalid-feedback">@error('max_discount_amount') {{ $message }} @enderror</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Minimum Order Amount (optional)</label>
                                <input type="number" step="0.01" name="min_order_amount" value="{{ old('min_order_amount', $coupon->min_order_amount) }}" class="form-control @error('min_order_amount') is-invalid @enderror">
                                <div class="invalid-feedback">@error('min_order_amount') {{ $message }} @enderror</div>
                            </div>
                             <div class="col-md-6">
                                <label class="form-label">Valid From</label>
                                <input type="datetime-local" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d\TH:i')) }}" class="form-control @error('start_date') is-invalid @enderror" required>
                                <div class="invalid-feedback">@error('start_date') {{ $message }} @enderror</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Valid Until</label>
                                <input type="datetime-local" name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d\TH:i')) }}" class="form-control @error('end_date') is-invalid @enderror" required>
                                <div class="invalid-feedback">@error('end_date') {{ $message }} @enderror</div>
                            </div>
                        </div>



                        <!-- Category/Sub/Child/Brand/Users -->
                        <div class="mb-3">
                            <label class="form-label">Category / Sub / Child / Brand / Users (optional)</label>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select name="category_id" id="category" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $coupon->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="sub_category_id" id="sub_category" class="form-control select2 mt-2">
                                        <option value="">Select Sub Category</option>
                                        @foreach($subCategories as $sub)
                                            <option value="{{ $sub->id }}" {{ old('sub_category_id', $coupon->sub_category_id) == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                     <select name="child_category_id" id="child_category" class="form-control select2 mt-2">
                                        <option value="">Select Child Category</option>
                                        @foreach($childCategories as $child)
                                            <option value="{{ $child->id }}" {{ old('child_category_id', $coupon->child_category_id) == $child->id ? 'selected' : '' }}>{{ $child->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                     <select name="brand_id" class="form-control select2 mt-2">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $coupon->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6 mb-3">
                                    <label class="form-label">Specific User (optional)</label>
                                     <select name="specific_user_id" class="form-control select2 mt-2">
                                        <option value="">Select Specific User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('specific_user_id', $coupon->specific_user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Specific Product (optional)</label>
                                     <select name="applicable_products[]" class="form-control select2 mt-2" multiple>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ in_array($product->id, old('applicable_products', json_decode($coupon->applicable_products) ?? [])) ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class=" col-md-4 mb-3">
                            <label class="form-label">Usage Limit Per Coupon</label>
                            <input type="number" name="usage_limit_per_coupon" value="{{ old('usage_limit_per_coupon', $coupon->usage_limit_per_coupon) }}" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Usage Limit Per User</label>
                            <input type="number" name="usage_limit_per_user" value="{{ old('usage_limit_per_user', $coupon->usage_limit_per_user) }}" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                                <label class="form-label">Auto Apply?</label>
                                <select name="is_auto_apply" class="form-control">
                                    <option value="0" {{ $coupon->is_auto_apply == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $coupon->is_auto_apply == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                        <div class="mb-3">
                            <label class="form-label">Notes (optional)</label>
                            <textarea name="notes" class="form-control">{{ old('notes', $coupon->notes) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success px-5">Update</button>
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
                        let selected = {{ $coupon->sub_category_id ?? 'null' }} == sub.id ? 'selected' : '';
                        $('#sub_category').append('<option value="'+sub.id+'" '+selected+'>'+sub.name+'</option>');
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
                        let selected = {{ $coupon->child_category_id ?? 'null' }} == child.id ? 'selected' : '';
                        $('#child_category').append('<option value="'+child.id+'" '+selected+'>'+child.name+'</option>');
                    });
                }
            });
        }
    });
});
</script>
@endpush
