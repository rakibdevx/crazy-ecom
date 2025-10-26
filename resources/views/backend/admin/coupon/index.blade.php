@extends('backend.layout.index')
@push('title')
    Coupons
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Coupons</li>
            </ol>
        </nav>
    </div>
    <!--end breadcrumb-->

    <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-bold flex-wrap font-text1">
        <a href="javascript:;"><span class="me-1">Total</span><span class="text-secondary">({{$total}})</span></a>
        <a href="javascript:;"><span class="me-1">Active</span><span class="text-secondary">({{$active}})</span></a>
        <a href="javascript:;"><span class="me-1">Inactive</span><span class="text-secondary">({{$inactive}})</span></a>
    </div>

    <div class="row g-3 justify-content-between">
        <div class="col-auto">
            <div class="position-relative">
                <input class="form-control px-5" type="search" id="customSearch" placeholder="Search Coupon">
                <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
            </div>
        </div>
        @can('Coupon-create')
        <div class="col-auto">
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <a href="{{route('admin.coupon.create')}}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Coupon</a>
            </div>
        </div>
        @endcan
    </div><!--end row-->

    <div class="card mt-4">
        <div class="card-body">
            <div class="coupon-table">
                    <table class="table align-middle nowrap w-100" id="data">
                        <thead class="table-light">
                            <tr>
                                <th>Sl</th>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugins')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        responsive: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('admin.coupon.index') }}',
            data: function(d) {
                d.search = $('#customSearch').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, responsivePriority: 1 },
            { data: 'code', name: 'code', responsivePriority: 1 },
            { data: 'discount_amount', name: 'discount_amount', responsivePriority: 2 },
            { data: 'discount_type', name: 'discount_type', responsivePriority: 3 },
            { data: 'start_date', name: 'start_date', responsivePriority: 4 },
            { data: 'end_date', name: 'end_date', responsivePriority: 5 },
            { data: 'status', name: 'status', responsivePriority: 6 },
            { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 },
        ],
        dom: '<"d-flex justify-content-between align-items-center mb-2"Bf>rt<"d-flex justify-content-between mt-3"lip>',
        buttons: [
            { extend: 'copy', text: '<i class="bx bx-copy me-2"></i> Copy', className: 'btn btn-sm btn-primary rounded-pill px-3 py-1' },
            { extend: 'csv', text: '<i class="bx bx-file me-2"></i> CSV', className: 'btn btn-sm btn-info rounded-pill px-3 py-1' },
            { extend: 'excel', text: '<i class="bx bx-spreadsheet me-2"></i> Excel', className: 'btn btn-sm btn-success rounded-pill px-3 py-1' },
            { extend: 'pdf', text: '<i class="bx bx-file me-2"></i> PDF', className: 'btn btn-sm btn-danger rounded-pill px-3 py-1' },
            { extend: 'print', text: '<i class="bx bx-printer me-2"></i> Print', className: 'btn btn-sm btn-secondary rounded-pill px-3 py-1' }
        ],
        pageLength: {{ setting('default_pagination') }},
        lengthMenu: [
            [10, 15, 25, 50, 100, {{ setting('default_pagination') }}],
            [10, 15, 25, 50, 100, {{ setting('default_pagination') }}]
        ],
        searching: false,
        language: {
            paginate: { previous: "<", next: ">" }
        },
    });

    $('#customSearch').on('keyup', function () {
        table.ajax.reload();
    });

    function deleteCoupon(url) {
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
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        Swal.fire('Deleted!', response.message, 'success').then(() => {
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
</script>
@endpush
