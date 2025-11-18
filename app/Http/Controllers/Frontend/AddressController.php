<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address_name' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'phone' => [
                'nullable',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'email'        => 'required|email|max:255',
            'shipping_zone_id' => 'required|exists:shipping_zones,id',
            'street_address'   => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);
        if($request->status == 'active')
        {
            $address = Address::where('user_id',Auth::guard('user')->user()->id,)->get();
            foreach($address as $add)
            {
                $add->update([
                    'status'=>'inactive'
                ]);
            }
        }

        Address::create([
            'user_id'         => Auth::guard('user')->user()->id,
            'address_name'    => $request->address_name,
            'name'            => $request->name,
            'phone'           => $request->phone,
            'email'           => $request->email,
            'shipping_zone_id'=>$request->shipping_zone_id,
            'street_address'  => $request->street_address,
            'status'          => $request->status,
        ]);

        return response()->json(['message' => 'Address saved successfully!']);
    }

    public function status(Request $request)
    {
        $userId = Auth::guard('user')->id();
        $address = Address::where('id', $request->address_id)
                        ->where('user_id', $userId)
                        ->firstOrFail();
        Address::where('user_id', $userId)->update(['status' => 'inactive']);

        $address->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Shipping Address updated successfully.');
    }

    public function delete($id)
    {
        $userId = Auth::guard('user')->id();
        $address = Address::where('id', $id)
                        ->where('user_id', $userId)
                        ->firstOrFail();

        $address->delete();
        
        $latest = Address::where('user_id', $userId)->latest()->first();

        if ($latest) {
            $latest->update([
                'status' => 'active'
            ]);
        }

        return redirect()->back()->with('success', 'Shipping Address Deleted Successfully.');
    }


}
