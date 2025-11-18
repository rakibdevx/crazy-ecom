<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class CouponService
{
    public function applyCoupon($code, User $user,$cart, Product $product = null)
    {
        $now = Carbon::now();
        // --- 1. Coupon Validation ---
        $coupon = Coupon::where('code', $code)
            ->where('status', 1)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Coupon is invalid or expired.'];
        }

        // --- 2. Vendor Restriction ---
        if ($coupon->vendor_id && $product && $product->vendor_id != $coupon->vendor_id) {
            return ['success' => false, 'message' => 'This coupon is not valid for this vendor.'];
        }

        // --- 3. Product Restriction ---
        if ($coupon->applicable_products && $product) {
            $allowedProducts = json_decode($coupon->applicable_products, true);

            if (!in_array($product->id, $allowedProducts)) {
                return ['success' => false, 'message' => 'Coupon not applicable for this product.'];
            }
        }

        // --- 4. Category Restriction ---
        if ($coupon->applicable_categories && $product) {
            $allowedCategories = json_decode($coupon->applicable_categories, true);

            if (!in_array($product->category_id, $allowedCategories)) {
                return ['success' => false, 'message' => 'Coupon not applicable for this category.'];
            }
        }

        // --- 5. Brand Restriction ---
        if ($coupon->applicable_brands && $product) {
            $allowedBrands = json_decode($coupon->applicable_brands, true);

            if (!in_array($product->brand_id, $allowedBrands)) {
                return ['success' => false, 'message' => 'Coupon not applicable for this brand.'];
            }
        }

        // --- 6. User Restriction ---
        // if ($coupon->user_type == 'new' && $user->orders()->count() > 0) {
        //     return ['success' => false, 'message' => 'Coupon only for new users.'];
        // }

        if ($coupon->specific_user_id && $coupon->specific_user_id != $user->id) {
            return ['success' => false, 'message' => 'Coupon not valid for this user.'];
        }

        // --- 7. Minimum Order Amount ---
        $price = 0;
        if($product)
        {
            if ($product->has_variants == 1)
            {
                $price = optional(
                    \App\Models\ProductVariant::where('product_id', $product->id)
                        ->where('color_id', $cart['color_id'])
                        ->where('size_id', $cart['size_id'])
                        ->first()
                )->price;
            }
            else {

                $price = $product->sale_price;
            }
        }

        if ($coupon->min_order_amount && $price < $coupon->min_order_amount) {
            return ['success' => false,'price'=>$price, 'message' => 'Minimum order amount not reached.'];
        }

        // --- 8. Calculate Discount ---
        $discount = 0;

        if ($coupon->discount_type == 'fixed') {
            $discount = $coupon->discount_amount;
        } elseif ($coupon->discount_type == 'percentage') {
            $discount = ($coupon->discount_amount / 100) * $price;
        }

        // --- 9. Max Discount Limit ---
        if ($coupon->max_discount_amount && $discount > $coupon->max_discount_amount) {
            $discount = $coupon->max_discount_amount;
        }

        return [
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'discount' => round($discount, 2),
            'final_price' => round($price - $discount, 2),
            'coupon_id' => $coupon->id,
        ];
    }
}
