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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Commission</li>
                    </ol>
                </nav>
            </div>
            @can('Commission-create')
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.commission.create')}}" class="btn btn-primary">Create</a>
                </div>
            </div>
            @endcan
        </div>

    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Commission</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Rate Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commissions as $commission)
                                    <tr>
                                        <td>{{ $commission->id }}</td>
                                        <td>{{ $commission->name }}</td>
                                        <td>{{ ucfirst($commission->type) }}</td>
                                        <td>{{ $commission->rate }}</td>
                                        <td>{{ ucfirst($commission->rate_type) }}</td>
                                        <td>{{format_date($commission->start_date)}}</td>
                                        <td>{{format_date($commission->end_date)}}</td>
                                        <td>{{ $commission->status == 'active' ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                            @can('Commission-edit')
                                                <a href="{{route('admin.commission.edit',$commission->id)}}" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                                    <i class="material-icons-outlined">settings</i>
                                                </a>
                                            @endcan
                                            @can('Commission-delete')
                                                <button onclick="deleteCommission('{{ route('admin.commission.destroy', $commission->id) }}')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                                    <i class="material-icons-outlined">delete</i>
                                                </button>
                                            @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       <div class="mt-3">
                            {{ $commissions->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteCommission(url) {
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
                           location.reload();
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
