<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionRule;
use App\Models\Commission;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Vendor;

use Illuminate\Http\Request;

class CommissionRulsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rules = CommissionRule::latest()->paginate(setting('default_pagination'));
        $commissions = Commission::where('status',)->latest()->get();
        return view('backend.admin.commissionRule.index',compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commissions = Commission::where('status','active')->latest()->get();
        $categories = Category::where('status','active')->get();
        $subcategories = Subcategory::where('status','active')->get();
        $vendors = Vendor::where('status','active')->get();

        return view('backend.admin.commissionRule.create', compact('commissions', 'categories', 'subcategories', 'vendors'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'commission_id' => 'required|exists:commissions,id',
            'applies_to' => 'required|string',
            'applies_id' => 'nullable|integer',
            'condition' => 'nullable|json',
            'priority' => 'required|integer',
        ]);

        CommissionRule::create([
            'commission_id' => $request->commission_id,
            'applies_to' => $request->applies_to,
            'applies_id' => $request->applies_id,
            'condition' => $request->condition ? json_decode($request->condition,true) : null,
            'priority' => $request->priority,
        ]);

        return back()->with('success','Rule created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(CommissionRule $commissionRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(CommissionRule $commissionRule)
    {
        $commissions = Commission::where('status','active')->latest()->get();
        $categories = Category::where('status','active')->get();
        $subcategories = Subcategory::where('status','active')->get();
        $vendors = Vendor::where('status','active')->get();

        return view('backend.admin.commissionRule.edit', compact('commissionRule','commissions', 'categories', 'subcategories', 'vendors'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommissionRule $commissionRule)
    {
        $request->validate([
            'commission_id' => 'required|exists:commissions,id',
            'applies_to' => 'required|string',
            'applies_id' => 'nullable|integer',
            'condition' => 'nullable|json',
            'priority' => 'required|integer',
        ]);
        $commissionRule->update([
            'commission_id' => $request->commission_id,
            'applies_to' => $request->applies_to,
            'applies_id' => $request->applies_id,
            'condition' => $request->condition ? json_decode($request->condition,true) : null,
            'priority' => $request->priority,
        ]);

        return back()->with('success','Rule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommissionRule $commissionRule)
    {
        //
    }
}
