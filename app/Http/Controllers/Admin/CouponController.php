<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Vendor;
use App\Models\User;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupon::query()->latest();
             if (request()->has('search')) {
                $search = request()->search;
                $coupons->where(function($q) use ($search) {
                    $q->where('code', 'like', '%'.$search.'%');
                });
            }
            return DataTables::of($coupons)
                ->addIndexColumn()

                ->addColumn('action', function($coupon) {
                    $edit = route('admin.coupon.edit', $coupon->id);
                    $deleteUrl = route('admin.coupon.destroy', $coupon->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Coupon-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Coupon-delete')) {
                        $action .= '
                            <button onclick="deleteCoupon(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->editColumn('status', function($row){
                    return '<span class="badge bg-'.($row->status == 'active' ? 'success' : 'secondary').'">'.$row->status.'</span>';
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        $total = Coupon::count();
        $active = Coupon::where('status','active')->count();
        $inactive = Coupon::where('status','inactive')->count();

        return view('backend.admin.coupon.index', compact('total','active','inactive'));
    }

    public function create()
    {
        $vendors = Vendor::where('status','active')->latest()->get();
        $users = User::where('status','active')->latest()->get();
        $categories = Category::where('status','active')->latest()->get();
        $brands = Brand::where('status','active')->latest()->get();
        $products = Product::where('status','active')->latest()->get();
        return view('backend.admin.coupon.create',compact('vendors','users','categories','brands','products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'nullable|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'child_category_id' => 'nullable|exists:child_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'specific_user_id' => 'nullable|exists:users,id',
            'applicable_products' => 'nullable|array',
            'applicable_products.*' => 'exists:products,id',
            'usage_limit_per_coupon' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'is_auto_apply' => 'required|boolean',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->max_discount_amount = $request->max_discount_amount;
        $coupon->min_order_amount = $request->min_order_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->category_id = $request->category_id;
        $coupon->sub_category_id = $request->sub_category_id;
        $coupon->child_category_id = $request->child_category_id;
        $coupon->brand_id = $request->brand_id;
        $coupon->specific_user_id = $request->specific_user_id;
        $coupon->applicable_products = $request->applicable_products ? json_encode($request->applicable_products) : null;
        $coupon->usage_limit_per_coupon = $request->usage_limit_per_coupon;
        $coupon->usage_limit_per_user = $request->usage_limit_per_user;
        $coupon->is_auto_apply = $request->is_auto_apply;
        $coupon->notes = $request->notes;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon created successfully!');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $childCategories = ChildCategory::all();
        $brands = Brand::all();
        $users = User::all();
        $products = Product::all();

        return view('backend.admin.coupon.edit', compact(
            'coupon', 'categories', 'brands', 'users', 'products','subCategories','childCategories'
        ));
    }

public function update(Request $request, $id)
{
    $coupon = Coupon::findOrFail($id);

    $request->validate([
        'code' => 'required|string|unique:coupons,code,' . $coupon->id,
        'discount_type' => 'required|in:fixed,percentage',
        'discount_amount' => 'required|numeric|min:0',
        'max_discount_amount' => 'nullable|numeric|min:0',
        'min_order_amount' => 'nullable|numeric|min:0',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'category_id' => 'nullable|exists:categories,id',
        'sub_category_id' => 'nullable|exists:sub_categories,id',
        'child_category_id' => 'nullable|exists:child_categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'specific_user_id' => 'nullable|exists:users,id',
        'applicable_products' => 'nullable|array',
        'applicable_products.*' => 'exists:products,id',
        'usage_limit_per_coupon' => 'nullable|integer|min:1',
        'usage_limit_per_user' => 'nullable|integer|min:1',
        'is_auto_apply' => 'required|boolean',
        'notes' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    // Update coupon
    $coupon->update([
        'code' => $request->code,
        'discount_type' => $request->discount_type,
        'discount_amount' => $request->discount_amount,
        'max_discount_amount' => $request->max_discount_amount,
        'min_order_amount' => $request->min_order_amount,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'category_id' => $request->category_id,
        'sub_category_id' => $request->sub_category_id,
        'child_category_id' => $request->child_category_id,
        'brand_id' => $request->brand_id,
        'specific_user_id' => $request->specific_user_id,
        'applicable_products' => $request->applicable_products ? json_encode($request->applicable_products) : null,
        'usage_limit_per_coupon' => $request->usage_limit_per_coupon,
        'usage_limit_per_user' => $request->usage_limit_per_user,
        'is_auto_apply' => $request->is_auto_apply,
        'notes' => $request->notes,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.coupon.index')->with('success', 'Coupon updated successfully!');
}

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['message' => 'Coupon deleted successfully']);
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->where('status','active')->get();
        return response()->json($subcategories);
    }

    public function getChildCategories($subCategoryId)
    {
        $childCategories = ChildCategory::where('sub_categories_id', $subCategoryId)->where('status','active')->get();
        return response()->json($childCategories);
    }

}
