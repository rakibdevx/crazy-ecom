<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Rules\ValidImage;
use Str;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Brand-view|Brand-create|Brand-edit|Brand-delete')->only(['index','store']);
        $this->middleware('permission:Brand-create')->only(['create','store']);
        $this->middleware('permission:Brand-edit')->only(['edit','update']);
        $this->middleware('permission:Brand-delete')->only(['destroy']);
    }

    public function index()
    {
        $query = Brand::select('id', 'name','image','status')->latest();
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
                ->addColumn('name', function($brand) {
                    $name = "-";
                    $image = $brand->image? asset($brand->image): asset(setting('default_brand_image'));
                    if ($brand->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$brand->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$brand->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('status', function($brand) {
                    switch ($brand->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'inactive':
                            return '<span class="badge bg-danger text-white">In Active</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$brand->status.'</span>';
                    }
                })
                ->addColumn('action', function($brand) {
                    $edit = route('admin.brand.edit', $brand->id);
                    $deleteUrl = route('admin.brand.destroy', $brand->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Brand-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Brand-delete')) {
                        $action .= '
                            <button onclick="deleteBrand(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
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

        return view('backend.admin.brand.index',compact([
            'total','active','inactive'
        ]));
    }



    public function create()
    {
        return view('backend.admin.brand.create');
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
            $filename = 'brand' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/brand'), $filename);
            $imagePath = 'backend/images/brand/' . $filename;
        }

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.brand.index')->with('success', 'Brand created successfully!');
    }

    // 4️⃣ Show single Brand
    public function show(Brand $brand)
    {
        //show
    }

    // 5️⃣ Show edit form
    public function edit(Brand $brand)
    {
        return view('backend.admin.brand.edit', compact('brand'));
    }

    // 6️⃣ Update brand
    public function update(Request $request, Brand $brand)
    {

        $request->validate([
            'name' => 'required|unique:brands,name,' . $brand->id,
            'status' => 'required|in:active,inactive',
            'image'=> ['nullable', 'file', new ValidImage()],
        ]);

        $imagePath = $brand->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($imagePath) {
                $oldPath = public_path($imagePath);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = 'brand' . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/images/brand'), $filename);
            $imagePath = 'backend/images/brand/' . $filename;
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.brand.index')->with('success', 'Brand updated successfully!');
    }

    // 7️⃣ Delete brand
    public function destroy(Brand $brand)
    {

        if ($brand->image) {
            $oldPath = public_path($brand->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

         try {
            $brand->delete();
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
