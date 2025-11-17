@extends('frontend.layout.index')
@push('title')
Reset Password
@endpush
@section('body')
 <div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li class="active">Reset Password</li>
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
                        <form id="verifyForm" action="{{route('resetPassword')}}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            @error('token')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="sin-order-tracking">
                                <label>Email</label>
                                @error('email')
                                    <div class="text-danger">Something Is Wrong With Email</div>
                                @enderror

                                <input type="email" placeholder="Email" value="{{$email}}" name="email">
                            </div>
                            <div class="sin-order-tracking">
                                <label>Password</label>
                                @error('password')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                                <input type="password" placeholder="password" name="password">
                            </div>
                            <div class="sin-order-tracking">
                                <label>Confirm Password</label>
                                @error('password_confirmation')
                                    <div class="text-danger">Something Is Wrong With Email</div>
                                @enderror
                                <input type="password" placeholder="Password Confirmation" name="password_confirmation">
                            </div>
                            <div class="order-track-btn d-flex align-items-center">
                                <a href="#" id="verifyBtn" class="btn btn-primary">Update</a>
                                <a href="{{route('login')}}" class="btn btn-info ms-1">Back to Log In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        document.getElementById('verifyBtn').addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('verifyForm').submit();
        });
    </script>
@endpush
