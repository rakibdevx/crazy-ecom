@extends('backend.layout.index')
@push('title')
Unverified Account
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
                        <li class="breadcrumb-item active" aria-current="page">Unverified Account</li>
                    </ol>
                </nav>
            </div>
        </div>
    <!--end breadcrumb-->
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-center" style="height: 80vh;">
                <a type="button" href="{{route('vendor.verification.resend')}}" class="btn btn-danger px-5 raised">Sent Verify Link Again</a>
            </div>
        </div>
    </div>
@endsection
