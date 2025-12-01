<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\DefaultShiping;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetails;
use App\Models\OrderStatusLog;
use App\Models\Product;
use App\Models\ShippingRate;
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

        DB::beginTransaction();

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
            $shipping_amount = 0;
            $cupon_id = null;

            foreach ($cart as $item) {

                $price = 0;
                $shipping_cost=0;

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


                if ($product->shipping_type == "product") {
                    $shipping_cost += $product->shipping_cost;
                }
                else if ($product->shipping_type == "flat") {
                    if ($product->vendor_id == null) {
                        $shipping_cost += optional(DefaultShiping::where('vendor_id', null)->first())->cost ?? 0;
                    } else {
                        $shipping_cost += optional(DefaultShiping::where('vendor_id', $product->vendor_id)->first())->cost ?? 0;
                    }
                }
                else if ($product->shipping_type == "zone") {
                    if ($product->vendor_id == null) {
                        $shipping_cost += optional(ShippingRate::where('vendor_id', null)
                            ->where('zone_id', $address->zone_id)
                            ->first())->cost ?? 0;
                    } else {
                        $shipping_cost += optional(ShippingRate::where('vendor_id', $product->vendor_id)
                            ->where('zone_id', $address->zone_id)
                            ->first())->cost ?? 0;
                    }
                }



                $subtotal += ($price * $item['quantity']);


                $code = session('coupon_code');

                // if($code)
                //     {
                //         $response = $couponService->applyCoupon(
                //             $code,
                //             $user,
                //             $item,
                //             $product
                //         );
                //         if (!$response['success']) continue;


                //         $discount += $response['discount'] ?? 0;
                //         $cupon_id = $response['coupon_id'];
                //     }
                //     return $code;

                $shipping_amount+= $shipping_cost;



                $det = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'sub_total' => $price * $item['quantity'],
                    'discount' => $response['discount'] ?? 0,
                    'final_price' => $response['final_price']?? $price * $item['quantity'],
                    'color_id' => $item['color_id'] ?? null,
                    'size_id' => $item['size_id'] ?? null,
                    'warranty' => $product->warranty ?? null,
                    'is_fragile' => $product->is_fragile ?? false,
                    'shipping_cost' => $shipping_cost,
                    'status' => 'pending',
                ]);

                Transaction::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'vendor_id' => $product->vendor_id??null,
                    'payment_gateway' => $request->payment_gateway ?? null,
                    'transaction_id' => null,
                    'type' => 'payment',
                    'amount' =>   $price * $item['quantity'] + $shipping_cost,
                    'status' => 'pending',
                ]);

                OrderStatusLog::create([
                    'order_id'   => $order->id,
                    'vendor_id'  => $product->vendor_id??null,
                    'old_status' => 'pending',
                    'new_status' => 'pending',
                    'changed_by' => $user->id,
                    'type' => 'user',
                    'notes'      => "Order Created",
                ]);
            }


            $order->subtotal = $subtotal;
            $order->shipping_amount = $shipping_amount;
            $order->coupon_discount = $discount;
            $order->total_items = count($cart);
            $order->currency = setting('currency');
            $order->coupon_id = $cupon_id;
            $order->grand_total = $subtotal - ($discount ?? 0) + ($shipping_amount ?? 0);
            $order->save();



            DB::commit();

            if($order->payment_method == 'ssl')
            {
                return redirect()->route('ssl.pay', ['order' => $order->order_number]);
            }


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
