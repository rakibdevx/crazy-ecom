<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
        public function __construct()
    {
        $this->middleware('permission:Slider-view|Slider-create|Slider-edit|Slider-delete')->only(['index','store']);
        $this->middleware('permission:Slider-create')->only(['create','store']);
        $this->middleware('permission:Slider-edit')->only(['edit','update']);
        $this->middleware('permission:Slider-delete')->only(['destroy']);
    }

    public function index()
    {
        $query = Slider::orderBy('sort_order');
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                ->orWhere('subtitle', 'like', '%'.$search.'%')
                ->orWhere('link', 'like', '%'.$search.'%')
                ->orWhere('button_text', 'like', '%'.$search.'%');
            });
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('title', function($slider) {
                    $title = "-";
                    $image = $slider->image? asset($slider->image): asset(setting('default_slider_image'));
                    if ($slider->title) {
                        $title = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$slider->title.'">
                                </div>
                                <p class="mb-0 customer-title fw-bold">'.$slider->title.'</p>
                            </a>
                        ';
                    }
                    return $title;
                })
                ->addColumn('link', function($slider) {
                    if($slider->link){
                        return '<a class="btn btn-primary" href="'.$slider->link.'" target="_blank">Link</a>';
                    }
                    return '-';
                })
                ->addColumn('status', function($slider) {
                    switch ($slider->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'inactive':
                            return '<span class="badge bg-danger text-white">In Active</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$slider->status.'</span>';
                    }
                })
                ->addColumn('action', function($slider) {
                    $edit = route('admin.sliders.edit', $slider->id);
                    $deleteUrl = route('admin.sliders.destroy', $slider->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Slider-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Slider-delete')) {
                        $action .= '
                            <button onclick="deleteSlider(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'title','status','link'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $active = (clone $query)->where('status', 'active')->count();
        $inactive = (clone $query)->where('status', 'inactive')->count();

        return view('backend.admin.slider.index',compact([
            'total','active','inactive'
        ]));
    }

    public function create()
    {
        return view('backend.admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'details' => 'nullable|string',
            'button_text' => 'nullable|string',
            'link' => 'nullable|url',
            'status' => 'required',
            'sort_order' => 'nullable|integer',
        ]);

        $imagePath = image_save('sliders', 'slider', $request->file('image'), '700x480');

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text ?? 'Learn More',
            'link' => $request->link,
            'details' => $request->details,
            'image' => $imagePath,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider added successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('backend.admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'details' => 'nullable|string',
            'link' => 'nullable|url',
            'status' => 'required',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if (File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }
            $slider->image = image_save('sliders', 'slider', $request->file('image'), '1200*500');
        }

        $slider->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text ?? 'Learn More',
            'link' => $request->link,
            'details' => $request->details,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {

         if ($slider->image) {
            $oldPath = public_path($slider->image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

         try {
            $slider->delete();
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
