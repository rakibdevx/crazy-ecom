@extends('frontend.layout.index')
@push('title')
Unverified
@endpush
@section('body')
 <div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li class="active">My account </li>
            </ul>
        </div>
    </div>
</div>
<div class="order-tracking-area pt-110 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-10 ms-auto me-auto">
                <div class="order-tracking-content">
                    <div class="order-tracking-form">
                        <div class="order-track-btn">
                            <a href="{{route('user.verification.resend')}}">Sent Verify Link Again</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
