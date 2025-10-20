<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ChildCategory;
use App\Models\DefaultShiping;
use App\Models\ShippingRate;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.admin.product.index');
    }

    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
        $brands = Brand::where('status','active')->latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        $default_shiping = DefaultShiping::where('vendor_id',null)->first();
        $Zone_rate = ShippingRate::where('vendor_id',null)->first();
        return view('backend.admin.product.create',compact('categories','brands','colors','sizes','Zone_rate','default_shiping'));
    }

 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:products,slug',
        'short_description' => 'nullable|string|max:500',
        'description' => 'nullable|string',
        'has_variants' => 'required|in:0,1',
        'cost_price' => 'required|numeric|min:0',
        'old_price' => 'nullable|numeric|min:0',
        'sale_price' => 'required|numeric|min:0',
        'sale_starts_at' => 'nullable|date',
        'sale_ends_at' => 'nullable|date|after_or_equal:sale_starts_at',
        'stock_quantity' => 'required_if:has_variants,0|integer|min:0',
        'shipping_type' => 'required|in:product,zone,flat',
        'shipping_cost' => 'nullable|numeric|min:0',
        'featured' => 'nullable|boolean',
        'trending' => 'nullable|boolean',
        'new' => 'nullable|boolean',
        'best_seller' => 'nullable|boolean',
        'sku' => 'nullable|string|max:255|unique:products,sku',
        'barcode' => 'nullable|string|max:255|unique:products,barcode',
        'weight_kg' => 'nullable|numeric|min:0',
        'length_cm' => 'nullable|numeric|min:0',
        'width_cm' => 'nullable|numeric|min:0',
        'height_cm' => 'nullable|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'nullable|exists:sub_categories,id',
        'child_category_id' => 'nullable|exists:child_categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'tags' => 'nullable|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500',
        'meta_keywords' => 'nullable|string|max:255',
        'colors' => 'nullable|array',
        'colors.*' => 'exists:colors,id',
        'sizes' => 'nullable|array',
        'sizes.*' => 'exists:sizes,id',
    ]);

    if($request->has_variants == 1){
        $request->validate([
            'variant_color_id' => 'required|array|min:1',
            'variant_color_id.*' => 'required|exists:colors,id',

            'variant_size_id' => 'required|array|min:1',
            'variant_size_id.*' => 'required|exists:sizes,id',

            'variant_stock' => 'required|array|min:1',
            'variant_stock.*' => 'required|integer|min:0',

            'variant_price' => 'required|array|min:1',
            'variant_price.*' => 'required|numeric|min:0',
        ]);
    }

    
    $product = Product::create($request->except([
        'variant_color_id','variant_size_id','variant_stock','variant_price'
    ]));

    if($request->has_variants == 1){
        foreach($request->variant_color_id as $key => $colorId){
            $product->variants()->create([
                'color_id' => $colorId,
                'size_id' => $request->variant_size_id[$key],
                'stock' => $request->variant_stock[$key],
                'price' => $request->variant_price[$key],
            ]);
        }
    }


        return $request;
        $request->validate([
            'ching' => 'required',
        ]);
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get(['id', 'name']);
        return response()->json($subCategories);
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_categories_id', $request->subcategory_id)->get(['id', 'name']);
        return response()->json($childCategories);
    }
}
