 @extends('backend.layout.index')
@push('title')
    Role
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Role</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.role.create')}}" class="btn btn-primary">Create</a>
                </div>
            </div>
        </div>

    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Role</h5>
                    </div>
                    <div class="card-body">
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$role->name}}</td>
                                       <td>{{ format_date($role->created_at)   }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{route('admin.role.show',$role->id)}}" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                                    <i class="material-icons-outlined">visibility</i>
                                                </a>
                                                <a href="{{route('admin.role.edit',$role->id)}}" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                                    <i class="material-icons-outlined">settings</i>
                                                </a>
                                                <button onclick="deleteVendor('{{ route('admin.role.destroy', $role->id) }}')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                                    <i class="material-icons-outlined">delete</i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Role Created</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                       <div class="mt-3">
                            {{ $roles->links('pagination::bootstrap-5') }}
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
