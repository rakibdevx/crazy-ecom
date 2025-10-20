<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingRate;
use App\Models\ShippingZone;
use App\Models\DefaultShiping;
use Illuminate\Http\Request;

class ShipingRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Shipping-rate')->only(['index','store']);
        $this->middleware('permission:Default-shiping')->only(['default']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $shippingzones = ShippingZone::select('id', 'name')->latest()->get();
        $default_shiping = DefaultShiping::where('vendor_id', null)->value('cost') ?? 0;
        $shippingzones = ShippingZone::with(['shippingRate' => function ($q) {
            $q->where('vendor_id', null);
        }])->get();

        return view('backend.admin.shiping_rate.index',compact('shippingzones','default_shiping'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [];
        foreach ($request->shipping_prices ?? [] as $zoneId => $price) {
            $rules['shipping_prices.'.$zoneId] = 'required|numeric|min:0';
        }
        $validated = $request->validate($rules);

        $existingZoneIds = array_keys($validated['shipping_prices'] ?? []);
        // return $existingZoneIds;
        ShippingRate::where('vendor_id', null)
            ->whereNotIn('shipping_zone_id', $existingZoneIds)
            ->delete();
        foreach ($validated['shipping_prices'] as $zoneId => $price) {
            ShippingRate::updateOrCreate(
                ['shipping_zone_id' => $zoneId, 'vendor_id' => null],
                ['cost' => $price]
            );
        }

        return back()->with('success', 'Shipping prices saved successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(ShippingRate $shippingRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingRate $shippingRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingRate $shippingRate)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingRate $shippingRate)
    {
        //
    }

    public function default(Request $request)
    {
        $request->validate([
            'default_shiping' => 'required|numeric|min:0',
        ]);

        DefaultShiping::updateOrCreate(
            ['vendor_id' => null],
            ['cost' => $request->default_shiping]
        );

        return back()->with('success', 'Default shipping cost saved successfully!');
    }

}
