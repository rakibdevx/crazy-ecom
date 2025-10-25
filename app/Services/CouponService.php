<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class CouponService
{
    /**
     * Apply coupon for a given user and product
     *
     * @param string $code
     * @param \App\Models\User $user
     * @param \App\Models\Product|null $product
     * @return array
     */
    public function applyCoupon($code, User $user, Product $product = null)
    {
        $coupon = Coupon::where('code', $code)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Coupon is invalid or expired.'];
        }

        // Vendor restriction
        if ($coupon->vendor_id && $product && $product->vendor_id != $coupon->vendor_id) {
            return ['success' => false, 'message' => 'This coupon is not valid for this vendor.'];
        }

        // Product restriction
        if ($coupon->applicable_products && $product) {
            $allowedProducts = json_decode($coupon->applicable_products, true);
            if (!in_array($product->id, $allowedProducts)) {
                return ['success' => false, 'message' => 'Coupon not applicable for this product.'];
            }
        }

        // Category restriction
        if ($coupon->applicable_categories && $product) {
            $allowedCategories = json_decode($coupon->applicable_categories, true);
            if (!in_array($product->category_id, $allowedCategories)) {
                return ['success' => false, 'message' => 'Coupon not applicable for this category.'];
            }
        }

        // Brand restriction
        if ($coupon->applicable_brands && $product) {
            $allowedBrands = json_decode($coupon->applicable_brands, true);
            if (!in_array($product->brand_id, $allowedBrands)) {
                return ['success' => false, 'message' => 'Coupon not applicable for this brand.'];
            }
        }

        // User restriction
        if ($coupon->user_restriction) {
            $restriction = json_decode($coupon->user_restriction, true);

            if (in_array('new_user', $restriction) && $user->orders()->count() > 0) {
                return ['success' => false, 'message' => 'Coupon only for new users.'];
            }

            // Optionally add specific user_ids
            if (isset($restriction['user_ids']) && !in_array($user->id, $restriction['user_ids'])) {
                return ['success' => false, 'message' => 'Coupon not valid for this user.'];
            }
        }

        // Calculate discount
        $discount = 0;
        $price = $product ? $product->sale_price : 0;

        if ($coupon->discount_type == 'fixed') {
            $discount = $coupon->discount_value;
        } elseif ($coupon->discount_type == 'percent') {
            $discount = ($coupon->discount_value / 100) * $price;
        }

        return [
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'discount' => $discount,
            'coupon_id' => $coupon->id,
        ];
    }
}
