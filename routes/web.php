<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    return "login";
})->name('login');

Route::get('/home', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    if (Auth::guard('vendor')->check()) {
        return redirect()->route('vendor.dashboard');
    }
    return redirect('/');
})->name('home');
