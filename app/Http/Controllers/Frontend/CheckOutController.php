<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Product;
use App\Models\ShippingZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CouponService;

class CheckOutController extends Controller
{
    public function index(CouponService $couponService)
    {
        $userId = Auth::guard('user')->id();

        $addresses = Address::where('user_id', $userId)->get();
        $carts = session()->get('cart', []);

        $productIds = array_column($carts, 'id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');


        $totalDiscount = 0;
        $code = session('coupon_code');
        $cupon = $code;
        if($code)
        {
            $user = Auth::guard('user')->user();

            foreach ($carts as $key => $item) {
                $product = Product::find($item['id']);

                $response = $couponService->applyCoupon(
                    $code,
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
                    $totalDiscount += $response['discount'];
                }
            }
        }

        $zones = ShippingZone::get();
         return view('frontend.user.checkout.index', compact('zones','addresses', 'carts','products','totalDiscount','cupon'));
    }
}
