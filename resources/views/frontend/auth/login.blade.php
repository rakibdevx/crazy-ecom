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
                <li class="active">Login </li>
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
                        @if (setting('user_registration_enabled') == 1)
                            <a class="{{ request()->routeIs('register') ? 'active' : '' }}" href="{{route('register')}}">
                                <h4> Register </h4>
                            </a>
                        @endif
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    @if(session('error'))
                                        <div class="text text-danger">{{ session('error') }}</div>
                                    @endif
                                     @if(session('success'))
                                        <div class="text text-success">{{ session('success') }}</div>
                                    @endif
                                    <form action="{{route('login')}}" method="post">
                                        @csrf
                                        @error('email')
                                        <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="email" name="email" placeholder="Email" value="{{old('email')}}">
                                        <input type="password" name="password" placeholder="Password">
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember">Remember me</label>
                                                <a href="{{route('forgot')}}">Forgot Password?</a>
                                            </div>
                                            <button type="submit">Login</button>
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
