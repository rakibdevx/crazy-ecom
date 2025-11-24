<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Size;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function ajaxAddToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $cart = session()->get('cart', []);

        // Optional color/size
        $color = $request->color ?? null;
        $size  = $request->size ?? null;
        $color_name = null;
        $size_name  = null;

        // Unique key: same product but different variant
        $key = $product->id;

        if ($color) {
            $key .= '-' . $color;
            $color_name = Color::where('id', $color)->value('code');
        }

        if ($size) {
            $key .= '-' . $size;
            $size_name = Size::where('id', $size)->value('name');
        }
        $price = 0;
        if ($product->has_variants == 1) {
            if($color == null)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please Select a Color!',
                ]);
            }
            if($size == null)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please Select a Size!',
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

        if(isset($cart[$key])) {
            $cart[$key]['quantity'] = $request->quantity;
        } else {
            $cart[$key] = [
                "id"       => $product->id,
                "name"     => $product->name,
                "slug"     => $product->slug,
                "quantity" => $request->quantity,
                "price"    => $price,
                "image"    => $product->thumbnail,
                "color"    => $color_name,
                "color_id"    => $color,
                "size"     => $size_name,
                "size_id"     => $size,
            ];
        }

        session()->put('cart', $cart);

        // Return JSON response
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart!',
            'cart_count' => count($cart),
            'cart_total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart))
        ]);
    }

    // Show Cart Page
    public function cart()
    {
        $cartItems = session()->get('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

        return view('frontend.user.cart.index', compact('cartItems', 'total'));
    }

    // Update Quantity
    public function updateCart(Request $request, $key)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if(isset($cart[$key])) {
            $cart[$key]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return back()->with('success', 'Cart updated!');
        }

        return back()->with('error', 'Item not found in cart!');
    }

    // Remove Item
    public function removeCart($key)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return back()->with('success', 'Item removed from cart!');
        }

        return back()->with('error', 'Item not found in cart!');
    }

    // Clear Entire Cart (Optional)
    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }


    public function applyCoupon(Request $request, CouponService $couponService)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (!$cart || count($cart) < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is empty.',
            ]);
        }

        $user = Auth::guard('user')->user();

        if(!$user){
            return response()->json([
                'status'         => 'error',
                'message'        => 'To Apply Cupon You Must need to Login',
            ]);
        }
        $results = [];
        $totalDiscount = 0;
        
        foreach ($cart as $key => $item) {
            $product = Product::find($item['id']);

            $response = $couponService->applyCoupon(
                $request->code,
                $user,
                $item,
                $product
            );

            if ($response['success'] == true) {
                $results[$key] = [
                    'product_id'  => $item['id'],
                    'original'    => $item['price'],
                    'discount'    => $response['discount'],
                    'final_price' => $response['final_price'],
                    'applicable'  => $response['success'],
                    'message'     => $response['message'],
                ];
            }


            if ($response['success']) {
                $totalDiscount += ($response['discount'] *$item['quantity']);
            }
        }

        session(['coupon_code' => $request->code]);

        return response()->json([
            'status'         => 'success',
            'message'        => 'Coupon applied successfully!',
            'items'          => $results,
            'total_discount' => $totalDiscount,
        ]);
    }



}
