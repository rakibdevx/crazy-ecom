@extends('backend.layout.index')
@push('title')
    Vendors
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Vendor</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-bold flex-wrap font-text1">
            <a href="javascript:;"><span class="me-1">Total</span><span class="text-secondary">({{$total}})</span></a>
            <a href="javascript:;"><span class="me-1">New</span><span class="text-secondary">({{$new}})</span></a>
            <a href="javascript:;"><span class="me-1">Active</span><span class="text-secondary">({{$active}})</span></a>
            <a href="javascript:;"><span class="me-1">Verified</span><span class="text-secondary">({{$verified}})</span></a>
            <a href="javascript:;"><span class="me-1">Pending</span><span class="text-secondary">({{$pending}})</span></a>
            <a href="javascript:;"><span class="me-1">Suspend</span><span class="text-secondary">({{$suspend}})</span></a>
        </div>

        <div class="row g-3 justify-content-between">
            <div class="col-auto">
                <div class="position-relative">
                    <input class="form-control px-5" type="search" id="customSearch" placeholder="Search Customers">
                    <span class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                </div>
            </div>
            @can('Vendor-create')
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <a href="{{route('admin.vendor.create')}}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Vendor</a>
                    </div>
                </div>
            @endcan
        </div><!--end row-->

        <div class="card mt-4">
            <div class="card-body">
                <div class="customer-table">
                    <div class="table-responsive white-space-nowrap">
                        <table class="table align-middle" id="data">
                            <thead class="table-light">
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Verified Seller</th>
                                    <th>Email Verified</th>
                                    <th>Last Login Time</th>
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
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
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
            ajax: {
                url: '{{ route('admin.vendor.index') }}',
                data: function (d) {
                    d.search = $('#customSearch').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'status', name: 'status' },
                { data: 'verified', name: 'verified' },
                { data: 'email_verified', name: 'email_verified' },
                { data: 'login', name: 'login' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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

        function deleteVendor(url) {
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
    </script>

    <script>
    function verifyVendor(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to verify this vendor?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
    </script>

@endpush
