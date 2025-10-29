<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{Brand, Category, SubCategory, ChildCategory, Product, ProductVariant};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Common product query builder with filters & sorting
     */
    private function filteredProducts(Request $request, $baseQuery)
    {
        // Price filter (with variants)
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $min = $request->min_price ?? 0;
            $max = $request->max_price ?? 9999999;

            $baseQuery->where(function($q) use ($min, $max) {
                $q->whereBetween('sale_price', [$min, $max])
                    ->orWhereHas('variants', fn($v) => $v->whereBetween('price', [$min, $max]));
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'price_low_high':
                $baseQuery->orderByRaw("
                    COALESCE(
                        (SELECT MIN(price) FROM product_variants WHERE product_variants.product_id = products.id),
                        products.sale_price
                    ) ASC
                ");
                break;

            case 'price_high_low':
                $baseQuery->orderByRaw("
                    COALESCE(
                        (SELECT MIN(price) FROM product_variants WHERE product_variants.product_id = products.id),
                        products.sale_price
                    ) DESC
                ");
                break;

            case 'popular':
                $baseQuery->orderBy('sold_count', 'desc');
                break;

            case 'random':
                $baseQuery->inRandomOrder();
                break;

            default:
                $baseQuery->latest();
                break;
        }

        return $baseQuery;
    }

    /**
     * Calculate min/max price for filters
     */
    private function priceRange($productQuery)
    {
        $productIds = $productQuery->pluck('id');

        $minProduct = Product::whereIn('id', $productIds)->min('sale_price') ?? 0;
        $maxProduct = Product::whereIn('id', $productIds)->max('sale_price') ?? 0;

        $minVariant = ProductVariant::whereIn('product_id', $productIds)->min('price') ?? 0;
        $maxVariant = ProductVariant::whereIn('product_id', $productIds)->max('price') ?? 0;

        return [
            'min' => min(round($minProduct), round($minVariant)),
            'max' => max(round($maxProduct), round($maxVariant)),
        ];
    }

    /**
     * Common data for filters
     */
    private function commonData()
    {
        return [
            'categories' => Category::where('status', 'active')->latest()->get(),
            'brands' => Brand::where('status', 'active')->latest()->get(),
        ];
    }

    /**
     * All products
     */
    public function index(Request $request)
    {
        $query = Product::with(['variants', 'category', 'brand'])
            ->where('status', 'active');

        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        if ($request->filled('category_ids')) {
            $query->whereIn('category_id', $request->category_ids);
        }

        if ($request->filled('brand_ids')) {
            $query->whereIn('brand_id', $request->brand_ids);
        }

        $query = $this->filteredProducts($request, $query);

        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(clone $query);
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
        ]));
    }

    /**
     * Category products
     */
    public function category_product(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->where('status','active')->firstOrFail();

        $query = Product::with(['variants', 'category', 'brand'])
            ->where('status', 'active')
            ->where('category_id', $category->id);

        $query = $this->filteredProducts($request, $query);
        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::where('category_id', $category->id));
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'category' => $category,
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
        ]));
    }

    /**
     * Sub-category products
     */
    public function sub_category_product(Request $request, $slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->where('status','active')->firstOrFail();

        $query = Product::with(['variants', 'category', 'brand', 'subcategory'])
            ->where('status', 'active')
            ->where('sub_category_id', $subcategory->id);

        $query = $this->filteredProducts($request, $query);
        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::where('sub_category_id', $subcategory->id));
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'subcategory' => $subcategory,
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
        ]));
    }

    /**
     * Child-category products
     */
    public function child_category_product(Request $request, $slug)
    {
        $childCategory = ChildCategory::where('slug', $slug)->where('status','active')->firstOrFail();

        $query = Product::with(['variants', 'category', 'brand', 'subcategory', 'childCategory'])
            ->where('status', 'active')
            ->where('child_category_id', $childCategory->id);

        $query = $this->filteredProducts($request, $query);
        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::where('child_category_id', $childCategory->id));
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'childCategory' => $childCategory,
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
        ]));
    }

    /**
     * Brand products
     */
    public function brand_product(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->where('status','active')->firstOrFail();

        $query = Product::with(['variants', 'category', 'brand'])
            ->where('status', 'active')
            ->where('brand_id', $brand->id);

        $query = $this->filteredProducts($request, $query);

        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::where('brand_id', $brand->id));
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'brand' => $brand,
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
        ]));
    }

    // Best Selling Products
    public function best_selling(Request $request)
    {
        $query = Product::with(['variants', 'category', 'brand'])
            ->where('best_sell','yes')
            ->where('status', 'active')
            ->orderBy('sold_count','desc');

        $query = $this->filteredProducts($request, $query);

        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::query());
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
            'datatype'=>'Best Selling Product',
        ]));
    }

    // Hot Deals Products
    public function hot_deals(Request $request)
    {
        $query = Product::with(['variants', 'category', 'brand'])
            ->where('hot_deals','yes')
            ->where('status', 'active');

        $query = $this->filteredProducts($request, $query);

        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::query());
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
            'datatype'=>'Hot Deals',
        ]));
    }

    // Featured Products
    public function featured(Request $request)
    {
        $query = Product::with(['variants', 'category', 'brand'])
            ->where('status', 'active')
            ->where('featured', 'yes');

        $query = $this->filteredProducts($request, $query);

        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::query());
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
            'datatype'=>'Featured',
        ]));
    }

    // Trending Products
    public function trending(Request $request)
    {
        $query = Product::with(['variants', 'category', 'brand'])
            ->where('status', 'active')
            ->where('trending', 'yes');

        $query = $this->filteredProducts($request, $query);

        $products = $request->filled('view')
            ? $query->paginate($request->view)->withQueryString()
            : $query->paginate(16)->withQueryString();

        $priceRange = $this->priceRange(Product::query());
        $data = $this->commonData();

        return view('frontend.product.index', array_merge($data, [
            'products' => $products,
            'minPriceFilter' => $priceRange['min'],
            'maxPriceFilter' => $priceRange['max'],
            'datatype'=>'Trending',
        ]));

    }


    public function details($slug)
    {
        $product = Product::where('status', 'active')
            ->where('slug', $slug)
            ->with([
                'category',
                'subcategory',
                'childCategory',
                'brand',
                'variants',
                'comments.user'
            ])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->with('brand', 'variants')
            ->take(8)
            ->get();

        return view('frontend.product.details', compact('product', 'relatedProducts'));
    }


}

