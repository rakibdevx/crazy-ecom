<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\CouponService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a new order with details and transaction.
     */
    public function store(Request $request,CouponService $couponService)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $address = \App\Models\Address::where('user_id', auth()->guard('user')->id())->where('status','active')->first();
        if(!$address)
        {
            return back()->with(['error' => "Please Add An Address First"]);
        }
        $cart = session()->get('cart', []);

        if (!$cart || count($cart) < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is empty.',
            ]);
        }
        $user = Auth::guard('user')->user();

        // DB::beginTransaction();

        try {
            $order = Order::create([
                'order_number' => setting('order_pre_text'). time(),
                'user_id' => $user->id,
                'name' => $address->name,
                'phone' => $address->phone,
                'email' => $address->email,
                'notes' => $request->notes ?? null,
                'is_gift' => $request->is_gift ?? false,
                'shipping_zone_id' => $address->shipping_zone_id,
                'street_address' => $address->street_address,
                'subtotal' => 0, // update later
                'discount' => 0,
                'grand_total' => 0,
                'total_items' => 0,
                'payment_method' => $request->payment_method ?? 'cash',
                'payment_status' => 'pending',
                'placed_at' => now(),
                'currency' => setting('currency'),
            ]);

            $subtotal = 0;
            $discount = 0;


            foreach ($cart as $item) {
                $price = 0;
                $shiping_cost=0;

                $product = Product::findOrFail($item['id']);

                if ($product->has_variants == 1) {

                    $color = $item['color_id'];
                    $size = $item['size_id'];

                    if($color == null)
                    {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Please Select a Color of '.$product->name,
                        ]);
                    }
                    if($size == null)
                    {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Please Select a Size '.$product->name,
                        ]);
                    }
                    $price = optional(
                        \App\Models\ProductVariant::where('product_id', $product->id)
                            ->where('color_id', $color)
                            ->where('size_id', $size)
                            ->first()
                    )->price;

                    if (!$price) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Please select a valid size and color!',
                        ]);
                    }
                }else
                {
                    $price = $product->sale_price;
                }

                $subtotal += ($price * $item['quantity']);

                $code = session('coupon_code');
                if($code)
                {
                    $response = $couponService->applyCoupon(
                        $code,
                        $user,
                        $item,
                        $product
                    );
                    if (!$response['success']) continue;
                }

                $orderd = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'sub_total' => $price * $item['quantity'],
                    'discount' => $response['discount'] ?? 0,
                    'final_price' => $response['final_price'],
                    'color_id' => $item['color_id'] ?? null,
                    'size_id' => $item['size_id'] ?? null,
                    'warranty' => $product->warranty ?? null,
                    'is_fragile' => $product->is_fragile ?? false,
                    'shipping_cost' => $shiping_cost,
                    'status' => 'pending',
                ]);


            }


            dd($order);

            $order->subtotal = $subtotal;
            $order->grand_total = $subtotal - ($request->discount ?? 0) + ($request->shipping_amount ?? 0);
            $order->save();

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
