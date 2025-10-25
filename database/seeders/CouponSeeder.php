<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $coupons = [
            [
                'code' => 'ADMIN10',
                'discount_type' => 'percentage',
                'discount_amount' => 10,
                'max_discount_amount' => 50,
                'min_order_amount' => 100,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(30),
                'status' => 'active',
            ],
            [
                'code' => 'VENDOR50',
                'discount_type' => 'fixed',
                'discount_amount' => 50,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(15),
                'vendor_id' => 2, // Vendor id
                'status' => 'active',
            ],
            [
                'code' => 'NEWUSER20',
                'discount_type' => 'percentage',
                'discount_amount' => 20,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(7),
                'user_type' => 'new',
                'status' => 'active',
            ],
            [
                'code' => 'EXIST50',
                'discount_type' => 'fixed',
                'discount_amount' => 50,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(10),
                'user_type' => 'existing',
                'status' => 'active',
            ],
            [
                'code' => 'CATEGORY15',
                'discount_type' => 'percentage',
                'discount_amount' => 15,
                'category_id' => 3,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(20),
                'status' => 'active',
            ],
            [
                'code' => 'BRAND25',
                'discount_type' => 'percentage',
                'discount_amount' => 25,
                'brand_id' => 4,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(10),
                'status' => 'active',
            ],
            [
                'code' => 'PRODUCT100',
                'discount_type' => 'fixed',
                'discount_amount' => 100,
                'applicable_products' => json_encode([1, 2, 3]),
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(5),
                'status' => 'active',
            ],
            [
                'code' => 'SPECIFICUSER30',
                'discount_type' => 'fixed',
                'discount_amount' => 30,
                'specific_user_id' => 5,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(10),
                'status' => 'active',
            ],
            [
                'code' => 'AUTO5',
                'discount_type' => 'fixed',
                'discount_amount' => 5,
                'is_auto_apply' => true,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(7),
                'status' => 'active',
            ],
            [
                'code' => 'LIMITED20',
                'discount_type' => 'percentage',
                'discount_amount' => 20,
                'usage_limit_per_coupon' => 50,
                'usage_limit_per_user' => 1,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(15),
                'status' => 'active',
            ],
        ];

        foreach ($coupons as $coupon) {
            DB::table('coupons')->insert(array_merge($coupon, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }
}
