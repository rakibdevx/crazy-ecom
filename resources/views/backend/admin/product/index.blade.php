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
    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="table-responsive white-space-nowrap">
                    <table class="table align-middle" id="data">
                        <thead class="table-light">
                            <tr>
                                <th>
                                <input class="form-check-input" type="checkbox">
                                </th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Sku</th>
                                <th>Stock</th>
                                <th>Total Sell</th>
                                <th>Brand</th>
                                <th>Status</th>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
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
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'sale_price', name: 'sale_price' },
                { data: 'sku', name: 'sku' },
                { data: 'stock', name: 'stock' },
                { data: 'sold_count', name: 'sold_count' },
                { data: 'brand', name: 'brand' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
            ],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
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


    </script>

@endpush
