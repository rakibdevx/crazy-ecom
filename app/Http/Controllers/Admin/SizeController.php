<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Str;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Size-view|Size-create|Size-edit|Size-delete')->only(['index','store']);
        $this->middleware('permission:Size-create')->only(['create','store']);
        $this->middleware('permission:Size-edit')->only(['edit','update']);
        $this->middleware('permission:Size-delete')->only(['destroy']);
    }

    public function index()
    {
        $query = Size::select('id', 'name')->latest();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            });
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($size) {
                    $name = "-";
                    if ($size->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <p class="mb-0 customer-name fw-bold">'.$size->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('action', function($size) {
                    $edit = route('admin.size.edit', $size->id);
                    $deleteUrl = route('admin.size.destroy', $size->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Size-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Size-delete')) {
                        $action .= '
                            <button onclick="SizeDelete(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','size'])
                ->make(true);
        }

        $total = (clone $query)->count();
        return view('backend.admin.size.index',compact([
            'total'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100|unique:sizes,name',
        ]);
        Size::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        return back()->with('success', 'Size created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('backend.admin.size.edit',compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:sizes,name,' . $size->id,
        ]);

        $size->name = $request->name;
        $size->slug = Str::slug($request->name);
        $size->save();

        return back()->with('success', 'Size Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        try {
            $size->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Size deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }
    }
}
