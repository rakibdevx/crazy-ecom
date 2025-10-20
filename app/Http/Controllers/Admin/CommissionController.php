<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commissions = Commission::paginate(setting('default_pagination'));
        return view('backend.admin.commissions.index',compact('commissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.commissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'custom_type' => 'nullable|string|max:255',
            'rate' => 'required|numeric|min:0',
            'rate_type' => 'required|in:percentage,flat',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $type = $request->type === 'custom' ? $request->custom_type : $request->type;

        Commission::create([
            'name' => $request->name,
            'type' => $type,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return back()->with('success','Commission created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commission $commission)
    {
        return view('backend.admin.commissions.edit',compact('commission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'custom_type' => 'nullable|string|max:255',
            'rate' => 'required|numeric|min:0',
            'rate_type' => 'required|in:percentage,flat',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $type = $request->type === 'custom' ? $request->custom_type : $request->type;

        $commission->update([
            'name' => $request->name,
            'type' => $type,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return back()->with('success','Commission updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commission $commission)
    {
        try {
            $commission->delete();
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
