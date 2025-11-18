<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status','active')->latest()->get();
        $categories = Category::where('status','active')->latest()->get();
        $sliders = Slider::where('status','active')->orderBy('sort_order')->get();
        $best_sells = Product::where('status','active')->orderBy('sold_count')->limit(10)->get();
        $trendings = Product::where('status','active')->where('trending','yes')->limit(10)->get();
        $featureds = Product::where('status','active')->where('featured','yes')->limit(10)->get();
        $deals = Product::where('status','active')->where('hot_deals','yes')->limit(10)->get();
        return view('frontend.home.index',compact('brands','categories','sliders','best_sells','trendings','featureds','deals'));
    }

    public function home()
    {
         if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('vendor')->check()) {
            return redirect()->route('vendor.dashboard');
        }
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        }
        return redirect('/');
    }


}
