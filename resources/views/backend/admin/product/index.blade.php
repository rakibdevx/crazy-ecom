@extends('backend.layout.index')
@push('title')
    Products
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
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-medium flex-wrap font-text1">
        <a href="javascript:;"><span class="me-1">All</span><span class="text-secondary">({{$total}})</span></a>
        <a href="javascript:;"><span class="me-1">Published</span><span class="text-secondary">({{$active}})</span></a>
        <a href="javascript:;"><span class="me-1">Drafts</span><span class="text-secondary">({{$draft}})</span></a>
        <a href="javascript:;"><span class="me-1">Trending Product</span><span class="text-secondary">({{$trending}})</span></a>
        <a href="javascript:;"><span class="me-1">Best Selling Item</span><span class="text-secondary">{{$best_selling}}</span></a>
        <a href="javascript:;"><span class="me-1">Featured Product</span><span class="text-secondary">({{$featured}})</span></a>
        <a href="javascript:;"><span class="me-1">Variant Product</span><span class="text-secondary">({{$variant}})</span></a>
        <a href="javascript:;"><span class="me-1">Stock</span><span class="text-secondary">({{$stock}})</span></a>
    </div>
    <div class="row g-3">
        <div class="col-auto">
            <div class="position-relative">
                <input class="form-control px-5" type="search" id="customSearch" placeholder="Search Products">
                <span
                class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
            </div>
        </div>
        <div class="col-auto flex-grow overflow-auto">
            <div class="btn-group position-static">
                    <div class="btn-group position-static">
                        <select name="category_id" id="category" class="form-control">
                            <option value="">Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            <div class="btn-group position-static">
                <div class="btn-group position-static">
                    <select name="sub_category" id="sub_category" class="form-control">
                        <option value="">Sub Category</option>
                        @foreach ($sub_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="btn-group position-static">
                <div class="btn-group position-static">
                    <select name="child_category" id="child_category" class="form-control">
                        <option value="">Child Category</option>
                        @foreach ($child_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="btn-group position-static">
                <div class="btn-group position-static">
                    <select name="brands" id="brand" class="form-control">
                        <option value="">Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <a href="{{route('admin.product.create')}}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Product</a>
            </div>
        </div>
    </div><!--end row-->
    <div class="row g-3 mt-3">
        <div class="col-auto">
           <style>
    #bulkActionGroup {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .bulk-toggle-group {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 6px;
        overflow: hidden;
    }

    .bulk-toggle-label {
        background: #f8f9fa;
        padding: 6px 10px;
        font-weight: 600;
        border-right: 1px solid #ddd;
        display: flex;
        align-items: center;
    }

    .bulk-action-btn {
        border: none;
        padding: 6px 12px;
        font-weight: 500;
        transition: 0.2s;
    }

    .bulk-action-btn:hover {
        opacity: 0.8;
    }

    .yes-btn {
        background-color: #198754;
        color: #fff;
    }

    .no-btn {
        background-color: #dc3545;
        color: #fff;
    }

    /* status group style */
    .status-btn {
        border-radius: 6px;
        color: #fff;
        font-weight: 600;
    }
</style>

<div class="btn-group mb-2" id="bulkActionGroup" style="display:none; transition: all 0.3s ease;">
    <!-- Status buttons -->
    <button type="button" class="btn btn-success status-btn bulk-action-btn" data-field="status" data-value="active">Active</button>
    <button type="button" class="btn btn-secondary status-btn bulk-action-btn" data-field="status" data-value="inactive">Inactive</button>
    <button type="button" class="btn btn-warning status-btn bulk-action-btn" data-field="status" data-value="draft">Draft</button>

    <!-- Hot Deals -->
    <div class="bulk-toggle-group">
        <div class="bulk-toggle-label">Hot Deals</div>
        <button type="button" class="bulk-action-btn yes-btn" data-field="hot_deals" data-value="yes">Yes</button>
        <button type="button" class="bulk-action-btn no-btn" data-field="hot_deals" data-value="no">No</button>
    </div>

    <!-- Featured -->
    <div class="bulk-toggle-group">
        <div class="bulk-toggle-label">Featured</div>
        <button type="button" class="bulk-action-btn yes-btn" data-field="featured" data-value="yes">Yes</button>
        <button type="button" class="bulk-action-btn no-btn" data-field="featured" data-value="no">No</button>
    </div>

    <!-- New -->
    <div class="bulk-toggle-group">
        <div class="bulk-toggle-label">New</div>
        <button type="button" class="bulk-action-btn yes-btn" data-field="new" data-value="yes">Yes</button>
        <button type="button" class="bulk-action-btn no-btn" data-field="new" data-value="no">No</button>
    </div>

    <!-- Trending -->
    <div class="bulk-toggle-group">
        <div class="bulk-toggle-label">Trending</div>
        <button type="button" class="bulk-action-btn yes-btn" data-field="trending" data-value="yes">Yes</button>
        <button type="button" class="bulk-action-btn no-btn" data-field="trending" data-value="no">No</button>
    </div>

    <!-- Best Seller -->
    <div class="bulk-toggle-group">
        <div class="bulk-toggle-label">Best Seller</div>
        <button type="button" class="bulk-action-btn yes-btn" data-field="best_sell" data-value="yes">Yes</button>
        <button type="button" class="bulk-action-btn no-btn" data-field="best_sell" data-value="no">No</button>
    </div>
</div>


        </div>
    </div><!--end row-->
    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="">
                    <table class="table align-middle nowrap w-100" id="data">
                        <thead class="table-light">
                            <tr>
                                <th>
                                <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Sku</th>
                                <th>Stock</th>
                                <th>Total Sell</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Hot Deals</th>
                                <th>New</th>
                                <th>Trending</th>
                                <th>Best Sell</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugins')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        var table = $('#data').DataTable({
            processing: true,
            serverSide: true,
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            ajax: {
                url: '{{ route('admin.product.index') }}',
                data: function (d) {
                    d.search = $('#customSearch').val();
                    d.category = $('#category').val();
                    d.sub_category = $('#sub_category').val();
                    d.child_category = $('#child_category').val();
                    d.brand = $('#brand').val();
                }
            },
            columns: [
                { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false , responsivePriority: 1 },
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false ,responsivePriority: 1},
                { data: 'name', name: 'name' , orderable: false, searchable: false, responsivePriority: 1 },
                { data: 'sale_price', name: 'sale_price' , orderable: false, searchable: false, responsivePriority: 3 },
                { data: 'sku', name: 'sku' , orderable: false, searchable: false, responsivePriority: 2 },
                { data: 'stock', name: 'stock' , orderable: false, searchable: false, responsivePriority: 4 },
                { data: 'sold_count', name: 'sold_count' , orderable: false, searchable: false, responsivePriority: 5 },
                { data: 'brand', name: 'brand' , orderable: false, searchable: false, responsivePriority: 6 },
                { data: 'status', name: 'status' , orderable: false, searchable: false, responsivePriority: 7 },
                { data: 'featured', name: 'featured' , orderable: false, searchable: false, responsivePriority: 8 },
                { data: 'hot_deals', name: 'hot_deals' , orderable: false, searchable: false, responsivePriority: 9 },
                { data: 'new', name: 'new' , orderable: false, searchable: false, responsivePriority: 10 },
                { data: 'trending', name: 'trending' , orderable: false, searchable: false, responsivePriority: 11 },
                { data: 'best_sell', name: 'best_sell' , orderable: false, searchable: false, responsivePriority: 12 },
                { data: 'created_at', name: 'created_at' , orderable: false, searchable: false, responsivePriority: 13 },
                { data: 'action', name: 'action' , orderable: false, searchable: false, responsivePriority: 1 },
            ],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="bx bx-copy me-2"></i> Copy',
                    className: 'btn btn-sm btn-primary rounded-pill shadow-sm px-3 py-1'
                },
                {
                    extend: 'csv',
                    text: '<i class="bx bx-file me-2"></i> CSV',
                    className: 'btn btn-sm btn-info rounded-pill shadow-sm px-3 py-1'
                },
                {
                    extend: 'excel',
                    text: '<i class="bx bx-spreadsheet me-2"></i> Excel',
                    className: 'btn btn-sm btn-success rounded-pill shadow-sm px-3 py-1'
                },
                {
                    extend: 'pdf',
                    text: '<i class="bx bx-file me-2"></i> PDF',
                    className: 'btn btn-sm btn-danger rounded-pill shadow-sm px-3 py-1'
                },
                {
                    extend: 'print',
                    text: '<i class="bx bx-printer me-2"></i> Print',
                    className: 'btn btn-sm btn-secondary rounded-pill shadow-sm px-3 py-1'
                }
            ],
            dom: '<"d-flex justify-content-between align-items-center mb-2"Bf>rt<"d-flex justify-content-between mt-3"lip>',

            pageLength: {{ setting('default_pagination') }},
            lengthMenu: [
                [10, 15, 25, 50, 100, {{ setting('default_pagination') }}],
                [10, 15, 25, 50, 100, {{ setting('default_pagination') }}]
            ],

            searching: false,
            responsive: true,
            language: {
                paginate: {
                    previous: "<",
                    next: ">",
                }
            },
        });

        $('#customSearch').on('keyup', function () {
            table.ajax.reload();
        });
        $('#category').on('change', function () {
            table.ajax.reload();
        });
        $('#sub_category').on('change', function () {
            table.ajax.reload();
        });
        $('#child_category').on('change', function () {
            table.ajax.reload();
        });
        $('#brand').on('change', function () {
            table.ajax.reload();
        });

        function deleteProduct(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                               table.ajax.reload(null, false);
                            });
                        },
                        error: function(err) {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        }

        $(function() {
            "use strict";
            $('#category, #sub_category, #child_category, #brand').select2({
                theme: "bootstrap-5",
                placeholder: function() {
                    return $(this).data('placeholder');
                }
            });
        });


        $('.bulk-action-btn').on('click', function() {
            let ids = [];
            $('#data .dt-checkbox:checked').each(function(){
                ids.push($(this).val());
            });

            if(ids.length === 0){
                Swal.fire('Error!', 'Select at least one product.', 'error');
                return;
            }

            let field = $(this).data('field');
            let value = $(this).data('value');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                     $.ajax({
                        url: "{{ route('admin.product.bulkUpdate') }}",
                        type: 'POST',
                        data: {
                            ids: ids,
                            field: field,
                            value: value,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res){
                            Swal.fire('Succcess!',res.message, 'success');
                            $('#data').DataTable().ajax.reload(null, false);
                            $('#data').on('draw.dt', function(){
                                $('#selectAll').prop('checked', false);
                            });
                        }
                    });
                }
            });

        });

        $('#selectAll').on('click', function() {
            let checked = $(this).is(':checked');
            $('#data .dt-checkbox').prop('checked', checked);
        });

        $('#data').on('click', '.dt-checkbox', function() {
            if(!$(this).is(':checked')){
                $('#selectAll').prop('checked', false);
            } else {
                let allChecked = $('#data .dt-checkbox').length === $('#data .dt-checkbox:checked').length;
                $('#selectAll').prop('checked', allChecked);
            }
        });


        let bulkGroupVisible = false;
        function toggleBulkActionGroup() {
            let anyChecked = $('#data .dt-checkbox:checked').length > 0;

            if(anyChecked && !bulkGroupVisible){
                $('#bulkActionGroup').fadeIn(200);
                bulkGroupVisible = true;
            } else if(!anyChecked && bulkGroupVisible){
                $('#bulkActionGroup').fadeOut(200);
                bulkGroupVisible = false;
            }
        }

        // Master checkbox
        $('#selectAll').on('click', function() {
            let checked = $(this).is(':checked');
            $('#data .dt-checkbox').prop('checked', checked);
            toggleBulkActionGroup();
        });

        // Individual checkbox
        $('#data').on('click', '.dt-checkbox', function() {
            toggleBulkActionGroup();

            // Optional: Master checkbox update
            let allChecked = $('#data .dt-checkbox').length === $('#data .dt-checkbox:checked').length;
            $('#selectAll').prop('checked', allChecked);
        });

        // Reset on table redraw
        $('#data').on('draw.dt', function(){
            toggleBulkActionGroup();
        });


    </script>



@endpush
