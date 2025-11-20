<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetails;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a new order with details and transaction.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $address = \App\Models\Address::where('user_id', auth()->guard('user')->id())->where('status','active')->first();
        if(!$address)
        {
            return back()->with(['error' => "Please Add An Address First"]);
        }
        
        DB::beginTransaction();

        try {
            $order = Order::create([
                'order_number' => 'ORD-' . time(),
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'notes' => $request->notes ?? null,
                'shipping_zone_id' => $request->shipping_zone_id,
                'street_address' => $request->street_address,
                'city' => $request->city ?? null,
                'subtotal' => 0, // update later
                'discount' => $request->discount ?? 0,
                'grand_total' => 0, // update later
                'total_items' => count($request->products),
                'payment_method' => $request->payment_method ?? 'cash',
                'payment_status' => 'pending',
                'placed_at' => now(),
            ]);

            $subtotal = 0;

            // 2. Create Order Details
            foreach ($request->products as $item) {
                $finalPrice = $item['price'] * $item['quantity'] - ($item['discount'] ?? 0);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'vendor_id' => $item['vendor_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'] ?? 0,
                    'final_price' => $finalPrice,
                    'color' => $item['color'] ?? null,
                    'size' => $item['size'] ?? null,
                    'warranty' => $item['warranty'] ?? null,
                    'is_fragile' => $item['is_fragile'] ?? false,
                    'status' => 'pending',
                ]);

                $subtotal += $finalPrice;
            }

            // 3. Update Order totals
            $order->subtotal = $subtotal;
            $order->grand_total = $subtotal - ($request->discount ?? 0) + ($request->shipping_amount ?? 0);
            $order->save();

            // 4. Optionally create transaction if payment is online
            if ($request->payment_method !== 'cash') {
                Transaction::create([
                    'order_id' => $order->id,
                    'user_id' => $request->user()->id,
                    'vendor_id' => null,
                    'payment_gateway' => $request->payment_gateway ?? null,
                    'transaction_id' => $request->transaction_id ?? null,
                    'type' => 'payment',
                    'amount' => $order->grand_total,
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Order placement failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
