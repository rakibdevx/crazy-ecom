<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return back()->with('error', "Somthing Is Wrong!Try Again.");
        }

        Newsletter::create(['email' => $request->email]);

        return back()->with('success', 'Thank you for subscribing!');
    }
}
