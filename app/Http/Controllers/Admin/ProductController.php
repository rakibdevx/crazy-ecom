<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\product;
use App\Models\Color;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\DefaultShiping;
use App\Models\ShippingRate;
use App\Models\Brand;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use Illuminate\Support\Str;
use App\Rules\ValidImage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ProductController extends Controller
{



    public function __construct()
    {
        $this->middleware('permission:Product-view|Product-create|Product-edit|Product-delete')->only(['index','store']);
        $this->middleware('permission:Product-create')->only(['create','store']);
        $this->middleware('permission:Product-edit')->only(['edit','update']);
        $this->middleware('permission:Product-delete')->only(['destroy']);
    }


    public function index()
    {
        $query = Product::select(
            'id', 'name','brand_id','category_id','sub_category_id','sale_price','has_variants','status','created_at','sku','sold_count','stock_quantity','thumbnail','featured','new','trending','best_sell','hot_deals'
            )
        ->with(['category:id,name'])
        ->with(['subCategory:id,name'])
        ->with(['brand:id,name'])
        ->with(['variants'])
        ->latest();
        // return $query->get();

        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%'.$search.'%')
                ->orWhere('sku', 'like', '%'.$search.'%')
                ->orWhere('barcode', 'like', '%'.$search.'%');
            });
        }

        if (request()->category != null) {
            $categoryId = request()->category;
            $query->where('category_id', $categoryId);
        }
        if (request()->sub_category != null) {
            $sub_category = request()->sub_category;
            $query->where('sub_category_id', $sub_category);
        }
        if (request()->child_category != null) {
            $child_category = request()->child_category;
            $query->where('child_category_id', $child_category);
        }
        if (request()->brand != null) {
            $brand = request()->brand;
            $query->where('brand_id', $brand);
        }



        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('checkbox', function($row) {
                    return '<input type="checkbox" name="" class="dt-checkbox" value="'.$row->id.'">';
                })
                ->addColumn('name', function($product) {
                    $name = "-";
                    $image = null;
                    if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                        $image = asset($product->thumbnail);
                    } else {
                        $image = asset(setting('default_product_image'));
                    }

                    $category = $product->category? $product->category->name: '-';
                    $subCategory = $product->subCategory? $product->subCategory->name: '-';
                    if ($product->name) {
                        $name = '
                             <div class="d-flex align-items-center gap-3">
                                <div class="product-box">
                                    <img src="'.$image.'" width="70" class="rounded-3" alt="'.$product->name.'">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:;" class="product-title">'.$product->name. '</a>
                                    <p class="mb-0 product-category"><strong>Category</strong> : '.$category.'</p>
                                    <p class="mb-0 product-category"><strong> Sub Category </strong> : '.$subCategory.'</p>
                                </div>
                            </div>
                        ';
                    }
                    return $name;
                })
                ->addColumn('status', function($product) {
                    switch ($product->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'inactive':
                            return '<span class="badge bg-danger text-white">In Active</span>';
                        default:
                            return '<span class="badge bg-secondary text-capitalize">'.$product->status.'</span>';
                    }
                })
                ->addColumn('sale_price', function($product) {
                    if ($product->has_variants == 0) {
                        return setting('currency_symbol') . $product->sale_price;
                    } else {
                        $minPrice = $product->variants->min('price');
                        $maxPrice = $product->variants->max('price');

                        if ($minPrice == $maxPrice) {
                            return $minPrice;
                        }

                        return setting('currency_symbol') .$minPrice . ' - ' . setting('currency_symbol'). $maxPrice;
                    }
                })
                ->addColumn('brand', function($product) {
                    return $product->brand ? $product->brand->name : '-';
                })

                ->addColumn('stock', function($product) {
                    if ($product->has_variants == 0) {
                        return $product->stock_quantity;
                    } else {
                        return $product->variants->sum('stock_quantity');
                    }
                })
                ->addColumn('featured', function($product){
                    return $product->featured == 'yes'
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">No</span>';
                })
                ->addColumn('new', function($product){
                    return $product->new == 'yes'
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">'.$product->new.'</span>';
                })
                ->addColumn('trending', function($product){
                    return $product->trending == 'yes'
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">No</span>';
                })
                ->addColumn('best_sell', function($product){
                    return $product->best_sell == 'yes'
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">No</span>';
                })
                ->addColumn('hot_deals', function($product){
                    return $product->hot_deals == 'yes'
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">No</span>';
                })

                ->addColumn('created_at', function($product) {
                    return format_date($product->created_at);
                })

                ->addColumn('action', function($product) {
                    $edit = route('admin.product.edit', $product->id);
                    $deleteUrl = route('admin.product.destroy', $product->id);
                    $show = route('admin.product.show', $product->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Product-view')) {
                        $action .= '
                            <a href="'.$show.'" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                <i class="material-icons-outlined">visibility</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Product-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Product-delete')) {
                        $action .= '
                            <button onclick="deleteProduct(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','status','sale_price','status','stock','brand','checkbox','featured','new','trending','best_sell','hot_deals'])
                ->make(true);
        }

        $categories = Category::where('status','active')->get();
        $sub_categories = SUbCategory::where('status','active')->get();
        $child_categories = ChildCategory::where('status','active')->get();
        $brands = Brand::get();
        $total = product::count();
        $active = product::where('status','active')->count();
        $draft = product::where('status','draft')->count();
        $trending = product::where('Trending',1)->count();
        $best_selling = product::where('best_sell',1)->count();
        $featured = product::where('featured',1)->count();
        $variant = product::where('has_variants',1)->count();

       $variantStock = ProductVariant::whereHas('product', function($q){
            $q->where('has_variants', 1);
        })->sum('stock_quantity');
        $noVariantStock = Product::where('has_variants', 0)->sum('stock_quantity');
        $stock = $variantStock + $noVariantStock;

        return view('backend.admin.product.index',compact([
            'categories',
            'sub_categories',
            'child_categories',
            'brands',
            'total',
            'active',
            'draft',
            'trending',
            'best_selling',
            'featured',
            'variant',
            'stock',
        ]));
    }

    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
        $products = product::where('status','active')->latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        $default_shiping = DefaultShiping::where('vendor_id',null)->first();
        $Zone_rate = ShippingRate::where('vendor_id',null)->first();
        $brands = Brand::get();
        return view('backend.admin.product.create',compact('categories','products','colors','sizes','Zone_rate','default_shiping','brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'has_variants' => 'required|in:0,1',
            'sale_starts_at' => 'nullable|date',
            'sale_ends_at' => 'nullable|date|after_or_equal:sale_starts_at',
            'shipping_type' => 'required|in:product,zone,flat',
            'shipping_cost' => 'nullable|numeric|min:0',
            'featured' => 'nullable|boolean',
            'trending' => 'nullable|boolean',
            'new' => 'nullable|boolean',
            'best_sell' => 'nullable|boolean',
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
            'product_id' => 'nullable|exists:products,id',
            'tags' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'pre_order' => 'nullable|boolean',
            'product_type' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive,draft',
            'specifications' => 'nullable|string',
            'thumbnail'=> ['nullable', 'file', new ValidImage()],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', new ValidImage()],
            'videos.*' => 'file|mimes:mp4,mov,avi,wmv|max:10240',
        ]);
        if ($request->has_variants == 1) {
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
        } else {
            $request->validate([
                'cost_price' => 'required|numeric|min:0',
                'old_price' => 'nullable|numeric|min:0',
                'sale_price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'colors' => 'nullable|array',
                'colors.*' => 'exists:colors,id',
                'sizes' => 'nullable|array',
                'sizes.*' => 'exists:sizes,id',
            ]);
        }

        DB::transaction(function() use ($request) {

            // ----------------- Slug -----------------
            $originalSlug = Str::slug($request->slug ?: $request->name);
            $slug = $originalSlug;
            $count = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            // ----------------- SKU -----------------
            $sku = $request->sku ?: Str::slug($request->name);
            $originalSku = $sku;
            $count = 1;
            while(Product::where('sku', $sku)->exists()) {
                $sku = $originalSku . '-' . $count;
                $count++;
            }

            // ----------------- Thumbnail -----------------

            $imagePath = image_save('product/thumbnail', 'thumbnail', $request->file('thumbnail'), '800x650');

            // ----------------- Product Data -----------------

            $productData = $request->only([
                'category_id', 'sub_category_id', 'child_category_id', 'brand_id','product_id',
                'name', 'sale_starts_at', 'sale_ends_at', 'has_variants',
                'pre_order', 'weight_kg','length_cm', 'width_cm', 'height_cm', 'product_type',
                'status','featured', 'new', 'trending', 'best_sell',
                'short_description','description', 'specifications','meta_title',
                'meta_description', 'meta_keywords', 'vendor_id', 'created_by'
            ]);

            $productData['stock_quantity'] = $request->has_variants ? 0 : ($request->stock_quantity ?? 0);
            $productData['low_stock_threshold'] = $request->low_stock_threshold ?? 10;
            $productData['slug'] = $slug;
            $productData['sku'] = $sku;
            $productData['barcode'] = $request->barcode ? $request->barcode : rand(10000,99999);
            $productData['thumbnail'] = $imagePath;

            $productData['tags'] = $request->filled('tags')
                ? (is_array($request->tags) ? json_encode($request->tags) : json_encode(explode(',', $request->tags)))
                : null;

            // Shipping
            $productData['shipping_type'] = $request->shipping_type;
            $productData['shipping_cost'] = $request->shipping_type === 'product' ? $request->shipping_cost : null;

            // Non-variant prices
            if ($request->has_variants == 0) {
                $productData['cost_price'] = $request->cost_price;
                $productData['old_price'] = $request->old_price;
                $productData['sale_price'] = $request->sale_price;
            }

            $product = Product::create($productData);

            // ----------------- Variants -----------------
            if ($request->has_variants == 1) {
                foreach ($request->variant_color_id as $key => $colorId) {
                    $product->variants()->create([
                        'color_id' => $colorId,
                        'size_id' => $request->variant_size_id[$key] ?? null,
                        'stock_quantity' => $request->variant_stock[$key],
                        'price' => $request->variant_price[$key],
                    ]);
                }
            } else {
                // Colors
                if ($request->colors) {
                    foreach ($request->colors as $colorId) {
                        $product->productColors()->create([
                            'color_id' => $colorId,
                        ]);
                    }
                }
                // Sizes
                if ($request->sizes) {
                    foreach ($request->sizes as $sizeId) {
                        $product->productSizes()->create([
                            'size_id' => $sizeId,
                        ]);
                    }
                }
            }

            // ----------------- Gallery Images -----------------
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $imageFile) {
                    $imagePath = image_save('product/gallery', 'gallery_' . $index, $imageFile,'800x650');
                    if ($imagePath) {
                        $product->gallery()->create([
                            'url' => $imagePath,
                        ]);
                    }
                }
            }


            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $index => $imageFile) {
                    $filename = 'videos_' . time() . '_' . $index . '.' . $imageFile->getClientOriginalExtension();
                    $destination = public_path('backend/videos/product');
                    if (!file_exists($destination)) mkdir($destination, 0777, true);
                    $imageFile->move($destination, $filename);
                    $product->video()->create([
                        'url' => 'backend/videos/product/' . $filename,
                    ]);
                }
            }

        }); // End transaction

        return back()->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with('productSizes')->with('productColors')->find($id);
        $categories = Category::where('status','active')->latest()->get();
        $products = product::where('status','active')->latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        $default_shipping = DefaultShiping::where('vendor_id',null)->first();
        $Zone_rate = ShippingRate::where('vendor_id',null)->first();
        $brands = Brand::get();
        return view('backend.admin.product.edit',compact('product','categories','products','colors','sizes','Zone_rate','default_shipping','brands'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'has_variants' => 'required|in:0,1',
            'sale_starts_at' => 'nullable|date',
            'sale_ends_at' => 'nullable|date|after_or_equal:sale_starts_at',
            'shipping_type' => 'required|in:product,zone,flat',
            'shipping_cost' => 'nullable|numeric|min:0',
            'featured' => 'nullable|boolean',
            'trending' => 'nullable|boolean',
            'new' => 'nullable|boolean',
            'best_sell' => 'nullable|boolean',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $id,
            'barcode' => 'nullable|string|max:255|unique:products,barcode,' . $id,
            'weight_kg' => 'nullable|numeric|min:0',
            'length_cm' => 'nullable|numeric|min:0',
            'width_cm' => 'nullable|numeric|min:0',
            'height_cm' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'child_category_id' => 'nullable|exists:child_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'product_id' => 'nullable|exists:products,id',
            'tags' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'pre_order' => 'nullable|boolean',
            'product_type' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive,draft',
            'specifications' => 'nullable|string',
            'thumbnail'=> ['nullable', 'file', new ValidImage()],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', new ValidImage()],
            'videos.*' => 'file|mimes:mp4,mov,avi,wmv|max:10240',
        ]);

        if ($request->has_variants == 1) {
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
        } else {
            $request->validate([
                'cost_price' => 'required|numeric|min:0',
                'old_price' => 'nullable|numeric|min:0',
                'sale_price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'colors' => 'nullable|array',
                'colors.*' => 'exists:colors,id',
                'sizes' => 'nullable|array',
                'sizes.*' => 'exists:sizes,id',
            ]);
        }

        DB::transaction(function() use ($request, $id) {

            $product = Product::with(['variants','productColors','productSizes'])->findOrFail($id);

            // ----------------- Slug -----------------
            $originalSlug = Str::slug($request->slug ?: $request->name);
            $slug = $originalSlug;
            $count = 1;
            while (Product::where('id','!=',$id)->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            // ----------------- SKU -----------------
            $sku = $request->sku ?: Str::slug($request->name);
            $originalSku = $sku;
            $count = 1;
            while(Product::where('id','!=',$id)->where('sku', $sku)->exists()) {
                $sku = $originalSku . '-' . $count;
                $count++;
            }

            // ----------------- Thumbnail -----------------
            $product->thumbnail = image_update( 'product/thumbnail', 'thumbnail', $request->file('thumbnail'), $product->thumbnail, '800x650');


            // ----------------- Product Data -----------------
            $product->fill($request->only([
                'category_id','sub_category_id','child_category_id','brand_id','product_id',
                'name','sale_starts_at','sale_ends_at','has_variants',
                'pre_order','weight_kg','length_cm','width_cm','height_cm','product_type',
                'status','featured','new','trending','best_sell',
                'short_description','description','specifications','meta_title',
                'meta_description','meta_keywords','vendor_id','created_by'
            ]));

            $product->stock_quantity = $request->has_variants ? 0 : ($request->stock_quantity ?? 0);
            $product->low_stock_threshold = $request->low_stock_threshold ?? 10;
            $product->slug = $slug;
            $product->sku = $sku;
            $product->barcode = $request->barcode ?: rand(10000,99999);
            $product->tags = $request->filled('tags')
                ? json_encode(is_array($request->tags) ? $request->tags : explode(',', $request->tags))
                : null;

            $product->shipping_type = $request->shipping_type;
            $product->shipping_cost = $request->shipping_type === 'product' ? $request->shipping_cost : null;

            if ($request->has_variants == 0) {
                $product->cost_price = $request->cost_price;
                $product->old_price = $request->old_price;
                $product->sale_price = $request->sale_price;
            }

            $product->save();

            // ----------------- Variants -----------------
            if ($request->has_variants == 1) {

                $product->variants()->delete();

                foreach ($request->variant_color_id as $key => $colorId) {
                    $product->variants()->create([
                        'color_id' => $colorId,
                        'size_id' => $request->variant_size_id[$key] ?? null,
                        'stock_quantity' => $request->variant_stock[$key],
                        'price' => $request->variant_price[$key],
                    ]);
                }

                // Non-variant related data null
                $product->cost_price = null;
                $product->old_price = null;
                $product->sale_price = null;
                $product->stock_quantity = 0;
                $product->productColors()->delete();
                $product->productSizes()->delete();
                $product->save();

            } else {
                $product->variants()->delete();

                // Colors & Sizes update
                $product->productColors()->delete();
                $product->productSizes()->delete();

                if ($request->colors) {
                    foreach ($request->colors as $colorId) {
                        $product->productColors()->create(['color_id' => $colorId]);
                    }
                }
                if ($request->sizes) {
                    foreach ($request->sizes as $sizeId) {
                        $product->productSizes()->create(['size_id' => $sizeId]);
                    }
                }

                $product->save();
            }

            // ----------------- Gallery Images -----------------
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $imageFile) {
                    $imagePath = image_save('product/gallery', 'gallery_' . $index, $imageFile, '800x650');
                    if ($imagePath) {
                        $product->gallery()->create([
                            'url' => $imagePath,
                        ]);
                    }
                }
            }

            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $index => $imageFile) {
                    $filename = 'videos_' . time() . '_' . $index . '.' . $imageFile->getClientOriginalExtension();
                    $destination = public_path('backend/videos/product');
                    if (!file_exists($destination)) mkdir($destination, 0777, true);
                    $imageFile->move($destination, $filename);
                    $product->video()->create([
                        'url' => 'backend/videos/product/' . $filename,
                    ]);
                }
            }

        });

        return back()->with('success','Product Updated successfully!');
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id) {
            $product = Product::with(['variants', 'productColors', 'productSizes', 'gallery', 'video'])->findOrFail($id);

            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }

            foreach ($product->gallery as $image) {
                if ($image->url && file_exists(public_path($image->url))) {
                    unlink(public_path($image->url));
                }
                $image->delete();
            }

            foreach ($product->video as $video) {
                if ($video->url && file_exists(public_path($video->url))) {
                    unlink(public_path($video->url));
                }
                $video->delete();
            }

            $product->variants()->delete();

            $product->productColors()->delete();
            $product->productSizes()->delete();

            $product->delete();
        });

        return back()->with('success', 'Product deleted successfully!');
    }

    public function deleteMedia(Request $request)
    {
        $request->validate([
            'type' => 'required|in:gallery,video',
            'ids'  => 'required|array|min:1',
            'ids.*'=> 'required|integer',
        ]);

        $type = $request->type;
        $ids = $request->ids;

        if ($type === 'gallery') {
            $exists = ProductImage::whereIn('id', $ids)->pluck('id')->toArray();
        } else {
            $exists = ProductVideo::whereIn('id', $ids)->pluck('id')->toArray();
        }

        $missing = array_diff($ids, $exists);
        if (!empty($missing)) {
            return response()->json([
                'success' => false,
                'message' => 'Some selected items are invalid or do not exist.',
                'missing_ids' => array_values($missing)
            ], 422);
        }

        // Delete items
        DB::transaction(function() use ($type, $exists) {
            if ($type === 'gallery') {
                $items = ProductImage::whereIn('id', $exists)->get();
                foreach ($items as $item) {
                    if ($item->url && file_exists(public_path($item->url))) unlink(public_path($item->url));
                    $item->delete();
                }
            } else {
                $items = ProductVideo::whereIn('id', $exists)->get();
                foreach ($items as $item) {
                    if ($item->url && file_exists(public_path($item->url))) unlink(public_path($item->url));
                    $item->delete();
                }
            }
        });

        return response()->json(['success' => true, 'message' => ucfirst($type).' deleted successfully']);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'exists:products,id',
            'field' => 'required|string|in:status,hot_deals,featured,new,trending,best_sell',
            'value' => 'required'
        ]);

        Product::whereIn('id', $request->ids)
        ->update([$request->field => $request->value]);

        return response()->json([
            'success' => true,
            'message' => 'Selected products updated successfully!'
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

