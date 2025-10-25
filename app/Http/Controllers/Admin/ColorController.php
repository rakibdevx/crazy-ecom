<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Color-view|Color-create|Color-edit|Color-delete')->only(['index','store']);
        $this->middleware('permission:Color-create')->only(['create','store']);
        $this->middleware('permission:Color-edit')->only(['edit','update']);
        $this->middleware('permission:Color-delete')->only(['destroy']);
    }

    public function index()
    {
        $query = Color::select('id', 'name','code')->latest();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('code', 'like', '%'.$search.'%');
            });
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($color) {
                    $name = "-";
                    if ($color->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <p class="mb-0 customer-name fw-bold">'.$color->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('color', function($color) {
                    return '<span style="display:inline-block; width:30px; height:30px; border-radius:4px; background-color:'.$color->code.';"></span>';
                })
                ->addColumn('action', function($color) {
                    $edit = route('admin.color.edit', $color->id);
                    $deleteUrl = route('admin.color.destroy', $color->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Color-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Color-delete')) {
                        $action .= '
                            <button onclick="deleteColor(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','color'])
                ->make(true);
        }

        $total = (clone $query)->count();
        return view('backend.admin.color.index',compact([
            'total'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100|unique:colors,name',
            'code' => 'required|string|max:7',
        ]);
        Color::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'code'=>$request->code,
        ]);
        return back()->with('success', 'Color created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('backend.admin.color.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
        'name' => 'required|string|max:100|unique:colors,name,' . $color->id,
        'code' => 'required|string|max:7',
    ]);

        $color->name = $request->name;
        $color->slug = Str::slug($request->name);
        $color->code = $request->code;
        $color->save();

        return redirect()->route('admin.color.index')->with('success', 'Color Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        try {
            $color->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Color deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }
    }
}
