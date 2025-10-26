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
                'code' => 'WELCOME10',
                'discount_type' => 'percentage',
                'discount_amount' => 10,
                'max_discount_amount' => 50,
                'min_order_amount' => 100,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(30),
                'vendor_id' => null, // Admin coupon
                'category_id' => null,
                'sub_category_id' => null,
                'child_category_id' => null,
                'brand_id' => null,
                'applicable_products' => null,
                'user_type' => 'new',
                'specific_user_id' => null,
                'usage_limit_per_coupon' => 100,
                'usage_limit_per_user' => 1,
                'is_auto_apply' => true,
                'notes' => '10% off for new users',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'FLAT50',
                'discount_type' => 'fixed',
                'discount_amount' => 50,
                'max_discount_amount' => null,
                'min_order_amount' => 300,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(15),
                'vendor_id' => null,
                'category_id' => 1,
                'sub_category_id' => 2,
                'child_category_id' => 3,
                'brand_id' => null,
                'applicable_products' => null,
                'user_type' => 'all',
                'specific_user_id' => null,
                'usage_limit_per_coupon' => 50,
                'usage_limit_per_user' => 2,
                'is_auto_apply' => false,
                'notes' => 'Flat 50 off for selected category',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'VENDOR25',
                'discount_type' => 'percentage',
                'discount_amount' => 25,
                'max_discount_amount' => 100,
                'min_order_amount' => 200,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(20),
                'vendor_id' => 2, // Vendor specific
                'category_id' => null,
                'sub_category_id' => null,
                'child_category_id' => null,
                'brand_id' => null,
                'applicable_products' => null,
                'user_type' => 'all',
                'specific_user_id' => null,
                'usage_limit_per_coupon' => 30,
                'usage_limit_per_user' => 1,
                'is_auto_apply' => false,
                'notes' => 'Vendor 25% off',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'BRAND15',
                'discount_type' => 'percentage',
                'discount_amount' => 15,
                'max_discount_amount' => 75,
                'min_order_amount' => 150,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(10),
                'vendor_id' => null,
                'category_id' => null,
                'sub_category_id' => null,
                'child_category_id' => null,
                'brand_id' => 1, // Brand specific
                'applicable_products' => null,
                'user_type' => 'all',
                'specific_user_id' => null,
                'usage_limit_per_coupon' => 50,
                'usage_limit_per_user' => 1,
                'is_auto_apply' => true,
                'notes' => 'Brand specific 15% discount',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Generate more random coupons to make 10
        for ($i = 4; $i < 10; $i++) {
            $coupons[] = [
                'code' => 'DEMO' . Str::upper(Str::random(5)),
                'discount_type' => $i % 2 == 0 ? 'fixed' : 'percentage',
                'discount_amount' => rand(10, 100),
                'max_discount_amount' => $i % 2 == 0 ? null : rand(50, 200),
                'min_order_amount' => rand(100, 500),
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(rand(5, 30)),
                'vendor_id' => rand(1,3) % 2 == 0 ? null : rand(1,3),
                'category_id' => rand(0,1) ? rand(1,3) : null,
                'sub_category_id' => rand(0,1) ? rand(1,3) : null,
                'child_category_id' => rand(0,1) ? rand(1,3) : null,
                'brand_id' => rand(0,1) ? rand(1,3) : null,
                'applicable_products' => null,
                'user_type' => ['all','new','existing'][rand(0,2)],
                'specific_user_id' => null,
                'usage_limit_per_coupon' => rand(10,100),
                'usage_limit_per_user' => rand(1,5),
                'is_auto_apply' => rand(0,1),
                'notes' => 'Demo coupon '.$i,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('coupons')->insert($coupons);
    }
}
