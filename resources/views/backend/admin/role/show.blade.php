 @extends('backend.layout.index')
@push('title')
    {{$role->name}}
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
                        <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Role</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$role->name}}</li>
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
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Role</h5>
                        <a href="{{route('admin.role.edit',$role->id)}}" class="btn btn-success p-0 px-1"><i class="bx bx-left-gear"></i>Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="pb-3">
                            <strong>Role Name:</strong> {{$role->name}}
                        </div>
                        <div class="row">
                            @foreach ($role->permissions as $permission)
                                <div class="col">
                                    <span class="badge rounded-pill bg-success">{{$permission->name}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
