<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['variants','category','brand'])
            ->where('status', 'active');

        if ($request->filled('category_ids')) {
            $query->whereIn('category_id', $request->category_ids);
        }

        if ($request->filled('brand_ids')) {
            $query->whereIn('brand_id', $request->brand_ids);
        }

        if ($request->filled('min_price')) {
            $query->where(function($q) use ($request) {
                $q->where('sale_price', '>=', $request->min_price)
                ->orWhereHas('variants', function($q2) use ($request) {
                    $q2->where('price', '>=', $request->min_price);
                });
            });
        }

        if ($request->filled('max_price')) {
            $query->where(function($q) use ($request) {
                $q->where('sale_price', '<=', $request->max_price)
                ->orWhereHas('variants', function($q2) use ($request) {
                    $q2->where('price', '<=', $request->max_price);
                });
            });
        }

        switch ($request->sort) {
            case 'price_low_high':
                $query->orderByRaw("
                    COALESCE(
                        (SELECT MIN(price) FROM product_variants WHERE product_variants.product_id = products.id),
                        products.sale_price
                    ) ASC
                ");
                break;

            case 'price_high_low':
                $query->orderByRaw("
                    COALESCE(
                        (SELECT MIN(price) FROM product_variants WHERE product_variants.product_id = products.id),
                        products.sale_price
                    ) DESC
                ");
                break;

            case 'popular':
                $query->orderBy('sold_count','desc');
                break;

            case 'random':
                $query->inRandomOrder();
                break;

            default:
                $query->latest();
                break;
        }
        if ($request->filled('view')) {
            $products = $query->paginate($request->view)->withQueryString();
        }else{
            $products = $query->paginate(15)->withQueryString();
        }


        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.index', compact('products','categories','brands'));
    }


    public function category_product($slug)
    {
        return "Category";
    }
}
