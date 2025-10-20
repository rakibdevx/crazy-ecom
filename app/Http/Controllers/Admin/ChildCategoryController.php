<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Str;

class ChildCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Child-category-view|Child-category-create|Child-category-edit|Child-category-delete')->only(['index','store']);
        $this->middleware('permission:Child-category-create')->only(['create','store']);
        $this->middleware('permission:Child-category-edit')->only(['edit','update']);
        $this->middleware('permission:Child-category-delete')->only(['destroy']);
    }


    public function index()
    {
        $query = ChildCategory::select('id', 'name','status','sub_categories_id')->with('subcategory','category')->latest();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('status', 'like', '%'.$search.'%');
            });
        }
        if (request()->category != null) {
            $categoryId = request()->category;
            $category = Category::with('subcategories')->find($categoryId);
            $subcategoryIds = $category && $category->subcategories
                ? $category->subcategories->pluck('id')->toArray()
                : [];
            $query->whereIn('sub_categories_id', $subcategoryIds);
        }
         if (request()->sub_category != null) {
            $sub_category = request()->sub_category;
            $query->where('sub_categories_id', $sub_category);
        }



        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($child_category) {
                    $name = "-";
                    if ($child_category->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <p class="mb-0 customer-name fw-bold">'.$child_category->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('status', function($child_category) {
                    switch ($child_category->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'inactive':
                            return '<span class="badge bg-danger text-white">In Active</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$child_category->status.'</span>';
                    }
                })
                ->addColumn('subcategory', function($child_category) {
                    $sub_category = '';
                    if($child_category->subcategory)
                    {
                        $sub_category = $child_category->subcategory->name;
                    }
                    return $sub_category;
                })

                ->addColumn('category', function($child_category) {
                    $category = '';
                    if($child_category->category)
                    {
                        $category = $child_category->category->name;
                    }
                    return $category;
                })

                ->addColumn('action', function($child_category) {
                    $edit = route('admin.child_category.edit', $child_category->id);
                    $deleteUrl = route('admin.child_category.destroy', $child_category->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Child-category-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Child-category-delete')) {
                        $action .= '
                            <button onclick="deleteChildCategory(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','status','subcategory','category'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $active = (clone $query)->where('status', 'active')->count();
        $inactive = (clone $query)->where('status', 'inactive')->count();
        $categories = Category::where('status','active')->latest()->get();
        $sub_categories = SubCategory::where('status','active')->latest()->get();
        return view('backend.admin.childcategory.index',compact([
            'total','active','inactive','categories','sub_categories'
        ]));
    }



    public function create()
    {
        $categories = Category::where('status','active')->get();
        return view('backend.admin.childcategory.create',compact('categories',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'      => 'required|exists:categories,id',
            'sub_category_id'  => 'required|exists:sub_categories,id',
            'name'             => 'required|string|max:255|unique:child_categories,name',
            'status'           => 'required|in:active,inactive',
        ]);

        ChildCategory::Create([
            'sub_categories_id'=>$request->sub_category_id,
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status
        ]);

        return back()->with('success', 'Child Category created successfully.');
    }


    public function show(ChildCategory $child_category)
    {
        //show
    }

    public function edit(ChildCategory $child_category)
    {
        $categories = Category::all();
        return view('backend.admin.childcategory.edit', compact('categories','child_category'));
    }

    public function update(Request $request, ChildCategory $child_category)
    {

        $request->validate([
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $child_category->sub_categories_id = $request->sub_category_id;
        $child_category->name = $request->name;
        $child_category->status = $request->status;
        $child_category->save();

        return back()->with('success', 'Child Category updated successfully.');

    }

    // 7️⃣ Delete category
    public function destroy(ChildCategory $child_category)
    {

        try {
            $child_category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'CHild Category deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }

    }

    public function getByCategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get(['id', 'name']);
        return response()->json($subCategories);
    }
}
