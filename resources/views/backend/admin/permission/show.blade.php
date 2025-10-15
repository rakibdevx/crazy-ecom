 @extends('backend.layout.index')
@push('title')
    {{$permission->name}}
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Permission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.permission.index')}}">Permission</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$permission->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.permission.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
                </div>
            </div>
        </div>

    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Permission</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Name : {{ $permission->name }}</li>
                            <li>
                                Last Update : {{ \Carbon\Carbon::parse($permission->updated_at)->format(setting('date_format')) }}
                            </li>
                            <li>
                                Created At : {{ \Carbon\Carbon::parse($permission->created_at)->format(setting('date_format')) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
