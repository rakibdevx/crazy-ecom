<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status','active')->latest()->get();
        $categories = Category::where('status','active')->latest()->get();
        return view('frontend.home.index',compact('brands','categories'));
    }


}
