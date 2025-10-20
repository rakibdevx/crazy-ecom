
@extends('backend.layout.index')
@push('title')
    Shipping Zone
@endpush
@section('body')
<div class="main-content">
    <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Shipping Zone</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shipping_zone.index')}}">Shipping Zone</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$shipping_zone->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.shipping_zone.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
                </div>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6 col-xl-6 d-flex">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card w-100 rounded-4">
                            <div class="card-header">
                                <h5>Edit Shipping Zone</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.shipping_zone.update',$shipping_zone->id) }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label">Name:</label>
                                        <input type="text" name="name"
                                            value="{{ old('name',$shipping_zone->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name" required>
                                        <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-success px-5 raised">Update</button>
                                        <a href="{{ route('admin.shipping_zone.index') }}" class="btn btn-primary px-5 raised">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
