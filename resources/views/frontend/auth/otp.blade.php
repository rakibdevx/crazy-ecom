@extends('frontend.layout.index')
@push('title')
Two Step Verification
@endpush
@section('body')
 <div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li class="active">Two Step Verification </li>
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
                        <h4 class="fw-bold mb-2">Two Step Verification</h4>
                        <p class="mb-4 ms-0 ps-0 text-muted text-start">We’ve sent a 6-digit verification code to your email. Please enter it below to verify your identity.</p>
                        <form id="verifyForm" action="{{route('user.otp.verify')}}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="sin-order-tracking">
                                <label>OTP</label>
                                @error('otp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('email')
                                    <div class="text-danger">Something Is Wrong With Email</div>
                                @enderror

                                <input type="text" value="{{old('otp')}}" minlength="6" name="otp" placeholder="Verification Code">
                            </div>
                            <div class="order-track-btn d-flex align-items-center">
                                <a href="#" id="verifyBtn" class="btn btn-primary">Verify</a>
                                <a href="{{route('user.resendOtp',$email)}}" class="btn btn-info ms-1">Resend Code</a>
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
