@extends('backend.layout.index')
@push('title')
    Create Product
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Left -->
            <div class="col-12 col-lg-8">
                @if ($errors->any())
                    <div class="card">
                        <div class="card-body">
                            @foreach ($errors->all() as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">

                        {{-- Product Title --}}
                        <div class="mb-4">
                            <h5 class="mb-3">Product Title</h5>
                            <input type="text" value="{{old('name')}}" class="form-control" name="name" placeholder="Write product title..." required>
                        </div>

                        {{-- Slug --}}
                        <div class="mb-4">
                            <h6 class="mb-2">Slug</h6>
                            <input type="text" value="{{old('slug')}}" class="form-control" name="slug" placeholder="Auto or manual slug">
                        </div>

                        {{-- Short Description --}}
                        <div class="mb-4">
                            <h5 class="mb-3">Short Description</h5>
                            <textarea class="form-control" name="short_description" rows="3" placeholder="Short summary of product...">{{old('short_description')}}</textarea>
                        </div>

                        {{-- Full Description --}}
                        <div class="mb-4">
                            <h5 class="mb-3">Description</h5>
                            <div id="quill-editor" class="mb-3" style="height: 250px;"></div>
                            <textarea name="description" class="form-control d-none" id="quill-editor-area">{{old('description')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-3">Product Images </h6>
                    </div>
                    <div class="card-body">
                         <div class="mb-4">
                            <h6 class="mb-3">Thumbnail Image (<small class="text-danger">Dimensions must be 800 x 650 pixels</small>)</h6>
                            <input id="thumbnail" type="file" name="thumbnail" accept="image/*">
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-3">Gallery Images (<small class="text-danger">Dimensions must be 800 x 650 pixels</small>)</h6>
                            <input id="images" type="file" name="images[]" multiple accept="image/*">
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-3">Videos</h6>
                            <input id="videos" type="file" name="videos[]" multiple accept="video/*">
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="mb-3">Inventory</h5>
                            <div class="row g-3">
                                <div class="col-12 col-lg-3">
                                    <div class="nav flex-column nav-pills border rounded vertical-pills overflow-hidden">
                                        <button class="nav-link active px-4 rounded-0" data-bs-toggle="pill" data-bs-target="#Pricing" type="button"><i class="bi bi-tag-fill me-2"></i>Pricing</button>
                                        <button class="nav-link px-4 rounded-0" data-bs-toggle="pill" data-bs-target="#Shipping" type="button"><i class="bi bi-truck-front-fill me-2"></i>Shipping</button>
                                        <button class="nav-link px-4 rounded-0" data-bs-toggle="pill" data-bs-target="#Attributes" type="button"><i class="bi bi-hdd-rack-fill me-2"></i>Attributes</button>
                                        <button class="nav-link px-4 rounded-0" data-bs-toggle="pill" data-bs-target="#Advanced" type="button"><i class="bi bi-gear-fill me-2"></i>Advanced</button>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <div class="tab-content">

                                        {{-- PRICING --}}
                                        <div class="tab-pane fade show active" id="Pricing">

                                            <div class="col-12 mb-3">
                                                <label class="form-label">Has Variants?</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="has_variants" id="variant_yes" value="1"  {{ old('has_variants') == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="variant_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input"type="radio"name="has_variants"id="variant_no"value="0" {{ old('has_variants', '0') == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="variant_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            {{-- VARIANTS --}}
                                            <div id="variantSection" class="card mt-3 d-none">
                                                <div class="card-body">
                                                    <div id="variantContainer">
                                                        <div id="variantContainer">
                                                            @php
                                                                $oldColors = old('variant_color_id', []);
                                                                $oldSizes = old('variant_size_id', []);
                                                                $oldStocks = old('variant_stock', []);
                                                                $oldPrices = old('variant_price', []);
                                                                $count = count($oldColors);
                                                            @endphp

                                                            @for($i = 0; $i < $count; $i++)
                                                                <div class="variant-row row g-3 align-items-end mb-2 border p-3 rounded bg-light position-relative">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Color</label>
                                                                        <select name="variant_color_id[]" class="form-select color-select" required>
                                                                            <option value="">-- Select Color --</option>
                                                                            @foreach($colors as $color)
                                                                                <option value="{{ $color->id }}" {{ $oldColors[$i] == $color->id ? 'selected' : '' }}>
                                                                                    {{ $color->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Size</label>
                                                                        <select name="variant_size_id[]" class="form-select size-select" required>
                                                                            <option value="">-- Select Size --</option>
                                                                            @foreach($sizes as $size)
                                                                                <option value="{{ $size->id }}" {{ $oldSizes[$i] == $size->id ? 'selected' : '' }}>
                                                                                    {{ $size->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">Stock</label>
                                                                        <input type="number" name="variant_stock[]" class="form-control" placeholder="Stock" value="{{ $oldStocks[$i] ?? '' }}" required>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Price</label>
                                                                        <input type="number" name="variant_price[]" class="form-control" placeholder="Price" value="{{ $oldPrices[$i] ?? '' }}" required>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-danger btn removeVariantBtn">
                                                                            <i class="bi bi-x-circle"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <button type="button" id="addVariantRow" class="btn btn-sm btn-primary mt-3"><i class="bi bi-plus-circle"></i> Add Variant</button>
                                                </div>
                                            </div>

                                            {{-- SIMPLE PRODUCT --}}
                                            <div id="simpleOptionSection" class="card mt-3">
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <h6 class="form-label">Colors</h6>
                                                            <select name="colors[]" id="colors" class="form-select" multiple>
                                                                @foreach($colors as $color)
                                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="form-label">Sizes</h6>
                                                            <select name="sizes[]" id="sizes" class="form-select" multiple>
                                                                @foreach($sizes as $size)
                                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 mt-3">
                                                        <div class="col-md-6">
                                                            <h6>Cost Price</h6>
                                                            <input class="form-control" name="cost_price" type="number" value="{{old('cost_price')}}" step="0.01" placeholder="{{setting('currency_symbol')}}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Sale Price</h6>
                                                            <input class="form-control" name="sale_price" type="number" value="{{old('sale_price')}}" step="0.01" placeholder="{{setting('currency_symbol')}}">
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 mt-3">
                                                        <div class="col-md-6">
                                                            <h6>Old Price</h6>
                                                            <input class="form-control" name="old_price" value="{{old('old_price')}}" type="number" placeholder="Old Price">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Stock Quantity</h6>
                                                            <input class="form-control" name="stock_quantity" value="{{old('stock_quantity')}}" type="number" placeholder="Quantity">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Low Stock Threshold</h6>
                                                            <input class="form-control" name="low_stock_threshold" value="{{old('low_stock_threshold')}}" type="number" placeholder="Low Stock Threshold">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- SHIPPING --}}
                                        <div class="tab-pane fade" id="Shipping">
                                            <div class="d-flex flex-column h-100">
                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold mb-2">Shipping Type</label>

                                                    {{-- Product-wise --}}
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="shipping_type" id="shippingProduct" value="product"
                                                            {{ old('shipping_type') == 'product' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="shippingProduct">
                                                            Product-wise Shipping
                                                        </label>
                                                        <div class="ps-4 small text-muted">
                                                            Set a custom shipping cost for this specific product.
                                                        </div>
                                                        <div id="productShippingCostInput" class="mt-2 {{ old('shipping_type') == 'product' ? '' : 'd-none' }}">
                                                            <label for="product_shipping_cost" class="form-label">Enter Product Shipping Cost</label>
                                                            <input type="number" step="0.01" min="0" class="form-control w-50" name="shipping_cost" id="product_shipping_cost" value="{{ old('shipping_cost') }}" placeholder="e.g. 120">
                                                        </div>
                                                    </div>

                                                    {{-- Flat-rate --}}
                                                    @if ($default_shiping ?? false)
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="shipping_type" id="shippingFlat" value="flat" {{ old('shipping_type', 'flat') == 'flat' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="shippingFlat">
                                                            Flat-rate Shipping
                                                        </label>
                                                        <div class="ps-4 small text-muted">
                                                            A flat shipping cost of <strong>{{ $default_shiping->cost ?? 0 }}</strong> applies.
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if ($Zone_rate ?? false)
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="shipping_type" id="zone_rate" value="zone" {{ old('shipping_type') == 'zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="zone_rate">
                                                            By Zone Shipping
                                                        </label>
                                                        <div class="ps-4 small text-muted">
                                                             Set a custom shipping cost for this specific <a href="{{route('admin.shipping_zone.index')}}">Zone</a>.
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ATTRIBUTES --}}
                                        <div class="tab-pane fade" id="Attributes">
                                            <h6 class="mb-3">Attributes</h6>
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <input id="featured" class="form-check-input" type="checkbox" name="featured" value="1"
                                                        {{ old('featured') ? 'checked' : '' }}>
                                                    <label for="featured">Featured</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <input id="new" class="form-check-input" type="checkbox" name="new" value="1"
                                                        {{ old('new') ? 'checked' : '' }}>
                                                    <label for="new">New</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <input id="trending" class="form-check-input" type="checkbox" name="trending" value="1"
                                                        {{ old('trending') ? 'checked' : '' }}>
                                                    <label for="trending">Trending</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <input id="best_sell" class="form-check-input" type="checkbox" name="best_sell" value="1"
                                                        {{ old('best_sell') ? 'checked' : '' }}>
                                                    <label for="best_sell">Best Seller</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ADVANCED --}}
                                        <div class="tab-pane fade" id="Advanced">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="mb-2">SKU</label>
                                                    <input class="form-control" type="text" value="{{old('sku')}}" name="sku" placeholder="SKU">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="mb-2">Barcode</label>
                                                    <input class="form-control" type="text" value="{{old('barcode')}}" name="barcode" placeholder="Barcode">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Weight (kg)</label>
                                                    <input class="form-control" type="number" value="{{old('weight_kg')}}" step="0.01" name="weight_kg">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Dimensions (L×W×H cm)</label>
                                                    <div class="d-flex gap-2">
                                                        <input class="form-control" value="{{old('length_cm')}}" type="number" step="0.01" name="length_cm" placeholder="L">
                                                        <input class="form-control" value="{{old('width_cm')}}" type="number" step="0.01" name="width_cm" placeholder="W">
                                                        <input class="form-control" value="{{old('height_cm')}}" type="number" step="0.01" name="height_cm" placeholder="H">
                                                    </div>
                                                </div>

                                                <div class="row g-3 mt-3">
                                                    <div class="col-md-6">
                                                        <h6>Sale Starts</h6>
                                                        <input type="date" name="sale_starts_at" value="{{old('sale_starts_at')}}" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Sale Ends</h6>
                                                        <input type="date" name="sale_ends_at" value="{{old('sale_ends_at')}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="pre_order" class="form-check-input" type="checkbox" name="pre_order" value="1"
                                                        {{ old('pre_order') ? 'checked' : '' }}>
                                                    <label for="pre_order">Pre Order</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-outline-danger flex-fill">
                                <i class="bi bi-x-circle me-2"></i>Discard
                            </a>
                            <button type="submit" name="status" value="draft" class="btn btn-outline-primary flex-fill">
                                <i class="bi bi-cloud-download me-2"></i>Draft
                            </button>
                            <button type="submit" name="status" value="active" class="btn btn-outline-success flex-fill">
                                <i class="bi bi-send me-2"></i>Publish
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Organize --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Organize</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="category" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Sub Category</label>
                                <select name="sub_category_id" id="subcategory" class="form-select">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Child Category</label>
                                <select name="child_category_id" id="childcategory" class="form-select">
                                    <option value="">Select Child Category</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Brand</label>
                                <select name="brand_id" id="brand" class="form-select">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Tags</label>
                                <input type="text" name="tags" value="{{old('tags')}}" class="form-control" placeholder="Comma separated">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEO --}}
                <div class="card">
                    <div class="card-body">
                        <h5>SEO Meta</h5>
                        <div class="mb-2">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title"  value="{{old('meta_title')}}" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control">{{old('meta_description')}}</textarea>
                        </div>
                        <div class="mb-2">
                            <label>Meta Keywords</label>
                            <input type="text" name="meta_keywords"  value="{{old('meta_keywords')}}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('plugins')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            var quillEditor = document.getElementById('quill-editor-area');

            var oldValue = `{!! old('description', '') !!}`;
            if (oldValue) {
                editor.root.innerHTML = oldValue;
            }

            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });

            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });
        }
    });

    $(function() {
        "use strict";
        function loadSubCategories(category_id, selected_id = null) {
            $('#subcategory').html('<option value="">Loading...</option>');
            $('#childcategory').html('<option value="">-- Select Child Category --</option>');

            if (category_id) {
                $.ajax({
                    url: "{{ route('admin.product.getSubCategories') }}",
                    type: "GET",
                    data: { category_id: category_id },
                    success: function(data) {
                        $('#subcategory').empty().append('<option value="">-- Select Sub Category --</option>');
                        $.each(data, function(key, value) {
                            var selected = (value.id == selected_id) ? 'selected' : '';
                            $('#subcategory').append('<option value="'+ value.id +'" '+selected+'>'+ value.name +'</option>');
                        });
                        $('#subcategory').trigger('change');
                        let oldSubCategory = "{{ old('sub_category_id') }}";
                        if (oldSubCategory) {
                            $('#subcategory').val(oldSubCategory).trigger('change');
                        }
                    },
                    error: function() {
                        $('#subcategory').html('<option value="">Error loading</option>');
                    }
                });
            } else {
                $('#subcategory').html('<option value="">-- Select Sub Category --</option>');
            }
        }
        function loadChildCategories(subcategory_id, selected_id = null) {
            $('#childcategory').html('<option value="">Loading...</option>');

            if (subcategory_id) {
                $.ajax({
                    url: "{{ route('admin.product.getChildCategories') }}",
                    type: "GET",
                    data: { subcategory_id: subcategory_id },
                    success: function(data) {
                        $('#childcategory').empty().append('<option value="">-- Select Child Category --</option>');
                        $.each(data, function(key, value) {
                            var selected = (value.id == selected_id) ? 'selected' : '';
                            $('#childcategory').append('<option value="'+ value.id +'" '+selected+'>'+ value.name +'</option>');
                        });
                        let oldCHildCategory = "{{ old('child_category_id') }}";
                        if (oldCHildCategory) {
                            $('#childcategory').val(oldCHildCategory).trigger('change');
                        }
                    },
                    error: function() {
                        $('#childcategory').html('<option value="">Error loading</option>');
                    }
                });
            } else {
                $('#childcategory').html('<option value="">-- Select Child Category --</option>');
            }
        }
        $('#category').on('change', function() {
            let category_id = $(this).val();
            loadSubCategories(category_id);
        });

        $('#subcategory').on('change', function() {
            let subcategory_id = $(this).val();
            loadChildCategories(subcategory_id);
        });
    });

    $(function() {
        "use strict";

        $('#colors, #sizes ,#brand,#category,#subcategory,#childcategory').select2({
            theme: "bootstrap-5",
            placeholder: "Select options"
        });
        let oldCategory = "{{ old('category_id') }}";
        if (oldCategory) {
            $('#category').val(oldCategory).trigger('change');
        }

        let oldbrand = "{{ old('brand_id') }}";
        if (oldbrand) {
            $('#brand').val(oldbrand).trigger('change');
        }

        let oldColors = @json(old('colors', []));
        let oldSizes = @json(old('sizes', []));

        if (oldColors.length > 0) {
            $('#colors').val(oldColors).trigger('change');
        }
        if (oldSizes.length > 0) {
            $('#sizes').val(oldSizes).trigger('change');
        }

        // Template for variant row
        function variantRowTemplate() {
            return `
                <div class="variant-row row g-3 align-items-end mb-2 border p-3 rounded bg-light position-relative">
                    <div class="col-md-3">
                        <label class="form-label">Color</label>
                        <select name="variant_color_id[]" class="form-select color-select" >
                            <option value="">-- Select Color --</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Size</label>
                        <select name="variant_size_id[]" class="form-select size-select" >
                            <option value="">-- Select Size --</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Stock</label>
                        <input type="number" name="variant_stock[]" class="form-control" placeholder="Stock" >
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="variant_price[]" class="form-control" placeholder="Price" >
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn removeVariantBtn">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                </div>`;
        }


        $('input[name="has_variants"]').on('change', function() {
            let value = $(this).val();
            if (value == 1) {
                $('#variantSection').removeClass('d-none').hide().slideDown(200);
                $('#simpleOptionSection').slideUp(200).addClass('d-none');
                $('#variantContainer').empty();
                addVariantRow();
            } else {
                $('#variantSection').slideUp(200).addClass('d-none');
                $('#simpleOptionSection').removeClass('d-none').hide().slideDown(200);
                $('#variantContainer').empty();
            }
        });

        let oldHasVariants = "{{ old('has_variants', 0) }}";
        if (oldHasVariants == 1) {
            $('#variantSection').removeClass('d-none').show();
            $('#simpleOptionSection').addClass('d-none');
            addVariantRow();
        } else {
            $('#simpleOptionSection').removeClass('d-none').show();
            $('#variantSection').addClass('d-none');
        }


        function addVariantRow() {
            let newRow = $(variantRowTemplate());
            $('#variantContainer').append(newRow.hide().slideDown(200));

            newRow.find('.color-select, .size-select').select2({
                theme: "bootstrap-5",
                placeholder: "Select option"
            });
        }


        $('#addVariantRow').on('click', function() {
            addVariantRow();
        });


        $(document).on('click', '.removeVariantBtn', function() {
            $(this).closest('.variant-row').slideUp(200, function() {
                $(this).remove();
            });
        });
    });

    $(function() {
        $('input[name="shipping_type"]').on('change', function() {
            if ($(this).val() === 'product') {
                $('#productShippingCostInput').removeClass('d-none').hide().slideDown(200);
            } else {
                $('#productShippingCostInput').slideUp(200, function() {
                    $(this).addClass('d-none');
                    $('#product_shipping_cost').val('');
                });
            }
        });

        const selected = $('input[name="shipping_type"]:checked').val();
        if (selected === 'product') {
            $('#productShippingCostInput').removeClass('d-none');
        }
    });
</script>



@endpush

