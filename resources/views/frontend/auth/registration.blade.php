@extends('frontend.layout.index')
@push('title')
Login
@endpush
@section('body')
<div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">Register </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area pt-115 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ms-auto me-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{route('login')}}">
                                    <h4> login </h4>
                                </a>
                                <a class="{{ request()->routeIs('register') ? 'active' : '' }}" href="{{route('register')}}">
                                    <h4> Register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="{{ route('register') }}" method="post">
                                                @csrf

                                                {{-- Name Error --}}
                                                @error('name')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">

                                                {{-- Email Error --}}
                                                @error('email')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">

                                                {{-- Password Error --}}
                                                @error('password')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="password" name="password" placeholder="Password">

                                                {{-- Confirm Password Error --}}
                                                @error('password_confirmation')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="password" name="password_confirmation" placeholder="Confirm Password">

                                                <div class="button-box">
                                                    <div class="login-toggle-btn">

                                                        @error('checkbox')
                                                        <div class="text text-danger">{{ $message }}</div>
                                                        @enderror

                                                        {{-- Terms & Conditions Checkbox --}}
                                                        <input type="checkbox" name="checkbox" id="terms"
                                                            {{ old('terms') ? 'checked' : '' }}>
                                                        <label for="terms">I agree to the <a href="">Terms & Conditions</a></label>

                                                    </div>

                                                    <button type="submit">Register</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
