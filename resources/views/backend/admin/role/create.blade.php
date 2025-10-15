 @extends('backend.layout.index')
@push('title')
    Create Role
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Create Role</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Role</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.role.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
                </div>
            </div>
        </div>

    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create New Role</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role.store') }}" method="POST"
                            class="row g-3 needs-validation">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" name="name"
                                    value="{{ old('name')}}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Name" required>
                                <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                            </div>
                            <div class="row mb-3">
                                <div class="div">
                                    <h6>Permissions</h6>
                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="checkbox" id="all_check">
                                        <label class="form-check-label" for="all_check">
                                            Check All
                                        </label>
                                    </div>
                                </div>
                                @error('permission')<div class="text-danger pt-2"> {{ $message }} </div> @enderror
                                <hr>
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input permission-checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                @checked(in_array($permission->name, old('permission', [])))
                                                type="checkbox"
                                                id="permission_{{ $permission->id }}">
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success px-5 raised">Create</button>
                                <a href="{{ route('admin.role.index') }}" class="btn btn-primary px-5 raised">Back</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const allCheck = document.getElementById('all_check');
        const permissions = document.querySelectorAll('.permission-checkbox');
        allCheck.addEventListener('change', function() {
            permissions.forEach(p => p.checked = this.checked);
        });
        permissions.forEach(p => {
            p.addEventListener('change', function() {
                const allChecked = Array.from(permissions).every(p => p.checked);
                allCheck.checked = allChecked;
            });
        });
    </script>
@endpush
