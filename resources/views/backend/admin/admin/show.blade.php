@extends('backend.layout.index')
@push('title')
    {{$admin->name}}
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.admin.index')}}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$admin->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.admin.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="position-relative">
                            <img src="{{$admin->banner_image?asset($admin->banner_image):asset(setting('default_profile_banner'))}}" class="img-fluid rounded" alt="">
                            <div class="position-absolute top-100 start-50 translate-middle">
                                <img src="{{$admin->profile_image?asset($admin->profile_image):asset(setting('default_profile_image'))}}" width="100" height="100"
                                    class="rounded-circle raised p-1 bg-white" alt="">
                            </div>
                        </div>
                        <div class="text-center mt-5 pt-4">
                            <h4 class="mb-1">{{$admin->name}}</h4>
                            <p class="mb-0">{{$admin->username}}</p>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Email</b>
                            <br>
                            {{$admin->email}}
                        </li>
                        @if($admin->phone)
                            <li class="list-group-item">
                                <b>Phone</b>
                                <br>
                                {{$admin->phone}}
                            </li>
                        @endif
                        @if($admin->roles->count())
                            <li class="list-group-item">
                                <b>Roles:</b>
                                <br>
                                @foreach($admin->roles as $role)
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
