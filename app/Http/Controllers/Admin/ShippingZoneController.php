<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingZone;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShippingZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Shipping-zone-view|Shipping-zone-create|Shipping-zone-edit|Shipping-zone-delete')->only(['index','store']);
        $this->middleware('permission:Shipping-zone-create')->only(['create','store']);
        $this->middleware('permission:Shipping-zone-edit')->only(['edit','update']);
        $this->middleware('permission:Shipping-zone-delete')->only(['destroy']);
    }

    public function index()
    {
        $query = ShippingZone::select('id', 'name')->latest();
        if ($search = request()->get('search')) {
            $query->where('name', 'like', '%'.$search.'%');
        }
        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($shippingZone) {
                    return $shippingZone->name
                        ? '<a class="d-flex align-items-center gap-3" href="javascript:;">
                            <p class="mb-0 customer-name fw-bold">' . $shippingZone->name . '</p>
                        </a>'
                        : '-';
                })
                ->addColumn('action', function($shippingZone) {
                    $editUrl = route('admin.shipping_zone.edit', $shippingZone->id);
                    $deleteUrl = route('admin.shipping_zone.destroy', $shippingZone->id);

                    $buttons = '<div class="btn-group" role="group" aria-label="Actions">';

                    if (auth('admin')->user()->can('Shipping-zone-edit')) {
                        $buttons .= '<a href="'.$editUrl.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                        <i class="material-icons-outlined">settings</i>
                                    </a>';
                    }

                    if (auth('admin')->user()->can('Shipping-zone-delete')) {
                        $buttons .= '<button onclick="deleteshippingZone(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                        <i class="material-icons-outlined">delete</i>
                                    </button>';
                    }

                    $buttons .= '</div>';

                    return $buttons;
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        $total = $query->count();

        return view('backend.admin.shipping.index', compact('total'));
    }

    public function create()
    {
        return view('backend.admin.shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:shipping_zones,name',
        ]);

        ShippingZone::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Shipping Zone created successfully!');
    }

    // 4️⃣ Show single ShippingZone
    public function show(ShippingZone $shippingzone)
    {
        //show
    }

    // 5️⃣ Show edit form
    public function edit(ShippingZone $shipping_zone)
    {
        return view('backend.admin.shipping.edit', compact('shipping_zone'));
    }

    // 6️⃣ Update ShippingZone
    public function update(Request $request, ShippingZone $shipping_zone)
    {

        $request->validate([
            'name' => 'required|unique:shipping_zones,name,' . $shipping_zone->id,
        ]);

        $shipping_zone->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Shipping Zone updated successfully!');
    }


    public function destroy(ShippingZone $shipping_zone)
    {
         try {
            $shipping_zone->delete();
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

