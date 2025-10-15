@extends('backend.layout.index')
@push('title')
    {{$vendor->name}}
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
                        <li class="breadcrumb-item"><a href="{{route('admin.vendor.index')}}">Vendor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$vendor->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('admin.vendor.index')}}" class="btn btn-primary px-4"><i class="bx bx-left-arrow-circle"></i>Back</a>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                        <div class="col-12 col-lg-4 d-flex">
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="position-relative">
                                        <img src="{{$vendor->banner_image?asset($vendor->banner_image):asset(setting('default_profile_banner'))}}" class="img-fluid rounded" alt="">
                                        <div class="position-absolute top-100 start-50 translate-middle">
                                            <img src="{{$vendor->profile_image?asset($vendor->profile_image):asset(setting('default_profile_image'))}}" width="100" height="100"
                                                class="rounded-circle raised p-1 bg-white" alt="">
                                        </div>
                                    </div>
                                    <div class="text-center mt-5 pt-4">
                                        <h4 class="mb-1">{{$vendor->name}}</h4>
                                        <p class="mb-0">{{$vendor->username}}</p>
                                    </div>
                                    @php
                                        $socialLinks = [
                                            'facebook' => $vendor->facebook ?? null,
                                            'twitter' => $vendor->twitter ?? null,
                                            'instagram' => $vendor->instagram ?? null,
                                            'linkedin' => $vendor->linkedin ?? null,
                                            'youtube' => $vendor->youtube ?? null,
                                        ];
                                    @endphp

                                    @if(collect($socialLinks)->filter()->isNotEmpty())
                                        <div class="d-flex align-items-center justify-content-center gap-3 my-5">
                                            @if($socialLinks['facebook'])
                                                <a href="{{ $socialLinks['facebook'] }}" target="_blank"
                                                class="wh-48 bg-facebook text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-facebook fs-5"></i>
                                                </a>
                                            @endif

                                            @if($socialLinks['twitter'])
                                                <a href="{{ $socialLinks['twitter'] }}" target="_blank"
                                                class="wh-48 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-twitter-x fs-5"></i>
                                                </a>
                                            @endif

                                            @if($socialLinks['instagram'])
                                                <a href="{{ $socialLinks['instagram'] }}" target="_blank"
                                                class="wh-48 bg-pink text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-instagram fs-5"></i>
                                                </a>
                                            @endif

                                            @if($socialLinks['linkedin'])
                                                <a href="{{ $socialLinks['linkedin'] }}" target="_blank"
                                                class="wh-48 bg-linkedin text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-linkedin fs-5"></i>
                                                </a>
                                            @endif

                                            @if($socialLinks['youtube'])
                                                <a href="{{ $socialLinks['youtube'] }}" target="_blank"
                                                class="wh-48 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-youtube fs-5"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center justify-content-around">
                                        <div class="d-flex flex-column gap-2">
                                        <h4 class="mb-0">798</h4>
                                        <p class="mb-0">Product</p>
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                        <h4 class="mb-0">48K</h4>
                                        <p class="mb-0">Order</p>
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                        <h4 class="mb-0">24.3M</h4>
                                        <p class="mb-0">Success</p>
                                        </div>
                                    </div>

                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-top">
                                        <b>Address</b>
                                        <br>
                                        {{$vendor->address}} {{$vendor->city}} {{$vendor->state}} {{$vendor->country}}
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b>
                                        <br>
                                        {{$vendor->email}}
                                    </li>
                                    @if($vendor->phone)
                                        <li class="list-group-item">
                                            <b>Phone</b>
                                            <br>
                                            {{$vendor->phone}}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 d-flex">
                            <div class="card w-100">
                                <div class="card-body">
                            <h5 class="mb-3">Orders<span class="fw-light ms-2">(98)</span></h5>
                            <div class="product-table">
                                <div class="table-responsive white-space-nowrap">
                                    <table class="table align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Order</th>
                                                <th>Expense</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
                                                <th>Delivery Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#2453</td>
                                                <td>$865</td>
                                                <td><span
                                                    class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Paid<i
                                                    class="bi bi-check2 ms-2"></i></span></td>
                                                <td><span
                                                    class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Completed<i
                                                    class="bi bi-check2 ms-2"></i></span></td>
                                                <td>Cash on delivery</td>
                                                <td>Jun 12, 12:56 PM</td>
                                                <td>
                                                    <a href="" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                                        <i class="material-icons-outlined">visibility</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div><!--end row-->
                    <div class="card mt-4">
                        <div class="card-body">
                        <h5 class="mb-3 fw-bold">Ratings & Reviews<span class="fw-light ms-2">(86)</span></h5>
                        <div class="product-table">
                            <div class="table-responsive white-space-nowrap">
                            <table class="table align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                    <a href="javascript:;" class="product-title">Women Pink Floral Printed Panelled Pure Cotton</a>
                                    </td>
                                    <td>
                                    <div class="product-rating text-warning">
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    </td>
                                    <td class="review-desc">This is very awesome product. It has good quality. I suggest everyone to use this
                                    product. It is available at very low amount.</td>
                                    <td><span
                                        class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Completed<i
                                        class="bi bi-check2 ms-2"></i></span></td>
                                    <td>Jun 12, 12:56 PM</td>
                                </tr>
                                <tr>
                                    <td>
                                    <a href="javascript:;" class="product-title">Women Pink Floral Printed Panelled Pure Cotton</a>
                                    </td>
                                    <td>
                                    <div class="product-rating text-warning">
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    </td>
                                    <td class="review-desc">This is very awesome product. It has good quality. I suggest everyone to use this
                                    product. It is available at very low amount.</td>
                                    <td><span
                                        class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">Failed<i
                                        class="bi bi-x-lg ms-2"></i></span></td>
                                    <td>Jun 12, 12:56 PM</td>
                                </tr>
                                <tr>
                                    <td>
                                    <a href="javascript:;" class="product-title">Women Pink Floral Printed Panelled Pure Cotton</a>
                                    </td>
                                    <td>
                                    <div class="product-rating text-warning">
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    </td>
                                    <td class="review-desc">This is very awesome product. It has good quality. I suggest everyone to use this
                                    product. It is available at very low amount.</td>
                                    <td><span
                                        class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Completed<i
                                        class="bi bi-check2-all ms-2"></i></span></td>
                                    <td>Jun 12, 12:56 PM</td>
                                </tr>
                                <tr>
                                    <td>
                                    <a href="javascript:;" class="product-title">Women Pink Floral Printed Panelled Pure Cotton</a>
                                    </td>
                                    <td>
                                    <div class="product-rating text-warning">
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    </td>
                                    <td class="review-desc">This is very awesome product. It has good quality. I suggest everyone to use this
                                    product. It is available at very low amount.</td>
                                    <td><span
                                        class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Completed<i
                                        class="bi bi-check2 ms-2"></i></span></td>
                                    <td>Jun 12, 12:56 PM</td>
                                </tr>
                                <tr>
                                    <td>
                                    <a href="javascript:;" class="product-title">Women Pink Floral Printed Panelled Pure Cotton</a>
                                    </td>
                                    <td>
                                    <div class="product-rating text-warning">
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    </td>
                                    <td class="review-desc">This is very awesome product. It has good quality. I suggest everyone to use this
                                    product. It is available at very low amount.</td>
                                    <td><span
                                        class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">Failed<i
                                        class="bi bi-x-lg ms-2"></i></span></td>
                                    <td>Jun 12, 12:56 PM</td>
                                </tr>
                                <tr>
                                    <td>
                                    <a href="javascript:;" class="product-title">Women Pink Floral Printed Panelled Pure Cotton</a>
                                    </td>
                                    <td>
                                    <div class="product-rating text-warning">
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-half"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    </td>
                                    <td class="review-desc">This is very awesome product. It has good quality. I suggest everyone to use this
                                    product. It is available at very low amount.</td>
                                    <td><span
                                        class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">Pending<i
                                        class="bi bi-info-circle ms-2"></i></span></td>
                                    <td>Jun 12, 12:56 PM</td>
                                </tr>

                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
