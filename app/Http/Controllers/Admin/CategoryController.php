<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Category-view|Category-create|Category-edit|Category-delete')->only(['index','store']);
        $this->middleware('permission:Category-create')->only(['create','store']);
        $this->middleware('permission:Category-edit')->only(['edit','update']);
        $this->middleware('permission:Category-delete')->only(['destroy']);
    }


    public function index()
    {
        $query = Category::select('id', 'name','image','status','slug');
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('status', 'like', '%'.$search.'%');
            });
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($category) {
                    $name = "-";
                    $image = $category->image? asset($category->image): asset(setting('default_product_image'));

                    if ($category->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$category->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$category->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('status', function($category) {
                    switch ($category->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'suspend':
                            return '<span class="badge bg-danger">Suspend</span>';
                        case 'pending':
                            return '<span class="badge bg-warning text-dark">Pending</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$category->status.'</span>';
                    }
                })
                ->addColumn('action', function($category) {
                    $edit = route('admin.category.edit', $category->id);
                    $deleteUrl = route('admin.category.destroy', $category->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Category-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Category-delete')) {
                        $action .= '
                            <button onclick="deleteCategory(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','status'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $active = (clone $query)->where('status', 'active')->count();
        $inactive = (clone $query)->where('status', 'inactive')->count();

        return view('backend.admin.category.index',compact([
            'total','active','inactive'
        ]));
    }



    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required|in:active,inactive',
            'image'=> ['nullable', 'file', new ValidImage()],
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/category'), $filename);
            $imagePath = 'backend/images/category/' . $filename;
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully!');
    }

    // 4️⃣ Show single category
    public function show(Category $category)
    {
        //show
    }

    // 5️⃣ Show edit form
    public function edit(Category $category)
    {
        return view('backend.admin.category.edit', compact('category'));
    }

    // 6️⃣ Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'status' => 'required|in:active,inactive',
            'image'=> ['nullable', 'file', new ValidImage()],
        ]);

        $imagePath = $category->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($imagePath) {
                $oldPath = public_path($imagePath);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/category'), $filename);
            $imagePath = 'backend/images/category/' . $filename;
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully!');
    }

    // 7️⃣ Delete category
    public function destroy(Category $category)
    {

        if ($category->image) {
            $oldPath = public_path($category->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

         try {
            $category->delete();
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
