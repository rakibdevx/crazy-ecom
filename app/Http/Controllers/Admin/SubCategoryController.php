<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\ValidImage;
use Str;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Sub-category-view|Sub-category-create|Sub-category-edit|Sub-category-delete')->only(['index','store']);
        $this->middleware('permission:Sub-category-create')->only(['create','store']);
        $this->middleware('permission:Sub-category-edit')->only(['edit','update']);
        $this->middleware('permission:Sub-category-delete')->only(['destroy']);
    }


    public function index()
    {
        $query = SubCategory::select('id', 'name','image','status','slug','category_id')->latest();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('status', 'like', '%'.$search.'%');
            });
        }

        if (request()->category != null) {
            $category = request()->category;
            $query->where(function($q) use ($category) {
                $q->where('category_id',$category);
            });
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($sub_category) {
                    $name = "-";
                    $image = $sub_category->image? asset($sub_category->image): asset(setting('default_sub_category_image'));
                    if ($sub_category->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$sub_category->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$sub_category->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('category', function($sub_category) {
                    $category = '';
                    if($sub_category->category)
                    {
                        $category = $sub_category->category->name;
                    }
                    return $category;
                })
                ->addColumn('status', function($sub_category) {
                    switch ($sub_category->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'inactive':
                            return '<span class="badge bg-danger text-white">inactive</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$sub_category->status.'</span>';
                    }
                })
                ->addColumn('action', function($sub_category) {
                    $edit = route('admin.sub_category.edit', $sub_category->id);
                    $deleteUrl = route('admin.sub_category.destroy', $sub_category->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Sub-category-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Sub-category-delete')) {
                        $action .= '
                            <button onclick="deleteSubCategory(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','status','category'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $active = (clone $query)->where('status', 'active')->count();
        $inactive = (clone $query)->where('status', 'inactive')->count();
        $categories = Category::where('status','active')->latest()->get();

        return view('backend.admin.subcategory.index',compact([
            'total','active','inactive','categories'
        ]));
    }



    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('backend.admin.subcategory.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories,name',
            'status' => 'required|in:active,inactive',
            'image'=> ['nullable', 'file', new ValidImage()],
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'category' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/sub_category'), $filename);
            $imagePath = 'backend/images/sub_category/' . $filename;
        }

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.sub_category.index')->with('success', 'Sub Category created successfully!');
    }

    // 4️⃣ Show single category
    public function show(SubCategory $sub_category)
    {
        //show
    }

    // 5️⃣ Show edit form
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('backend.admin.subcategory.edit', compact('categories','sub_category'));
    }

    // 6️⃣ Update category
    public function update(Request $request, SubCategory $sub_category)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:categories,name,' . $sub_category->id,
            'status' => 'required|in:active,inactive',
            'image'=> ['nullable', 'file', new ValidImage()],
        ]);

        $imagePath = $sub_category->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($imagePath) {
                $oldPath = public_path($imagePath);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'sub_category' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/sub_category'), $filename);
            $imagePath = 'backend/images/sub_category/' . $filename;
        }

        $sub_category->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.sub_category.index')->with('success', 'Sub Category updated successfully!');
    }

    // 7️⃣ Delete category
    public function destroy(SubCategory $sub_category)
    {

        if ($sub_category->image) {
            $oldPath = public_path($sub_category->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

         try {
            $sub_category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }

    }
}
