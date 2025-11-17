@extends('frontend.layout.index')
@push('title')
Forgot Password
@endpush
@section('body')
 <div class="breadcrumb-area bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li class="active">Forgot Password </li>
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
                        <form id="verifyForm" action="{{route('forgot.submit')}}" method="POST">
                            @csrf
                            <div class="sin-order-tracking">
                                <label>Email</label>
                                @error('email')
                                    <div class="text-danger">Something Is Wrong With Email</div>
                                @enderror

                                <input type="email" placeholder="Email" value="{{old('forgot')}}" minlength="6" name="email">
                            </div>
                            <div class="order-track-btn">
                                <a href="#" id="verifyBtn" class="btn btn-primary">Sent Code</a>
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
