@extends('frontend.layout.index')
@push('title')
Dashboard
@endpush
@section('body')
<div class="my-account-wrapper pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <div class="row">
                        @include('frontend.user.sidebar.index')
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <div class="" >
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>
                                        <div class="welcome">
                                            <p>Hello, <strong>Alex Tuntuni</strong> (If Not <strong>Tuntuni !</strong><a href="login-register.html" class="logout"> Logout</a>)</p>
                                        </div>

                                        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
@endsection
