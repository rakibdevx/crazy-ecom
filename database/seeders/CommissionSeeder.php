<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commission;
use App\Models\CommissionRule;

class CommissionSeeder extends Seeder
{
    public function run(): void
    {
        $global = Commission::create([
            'name' => 'Global Commission',
            'type' => 'global',
            'rate' => 8,
            'rate_type' => 'percentage',
            'status' => 'active',
            'start_date' => null,
            'end_date' => null,
        ]);

        // Commission rules
        CommissionRule::create([
            'commission_id' => $global->id,
            'applies_to' => 'global',
            'applies_id' => null,
            'condition' => null,
            'priority' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $electronics = Commission::create([
            'name' => 'Electronics Offer',
            'type' => 'category',
            'rate' => 10,
            'rate_type' => 'percentage',
            'status' => 'active',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addMonths(1)->format('Y-m-d'),
        ]);

        CommissionRule::create([
            'commission_id' => $electronics->id,
            'applies_to' => 'category',
            'applies_id' => 1,
            'condition' => json_encode(['min_order' => 1000]),
            'priority' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Example vendor-specific commission
        $vendorCommission = Commission::create([
            'name' => 'Special vendor Commission',
            'type' => 'vendor',
            'rate' => 12,
            'rate_type' => 'percentage',
            'status' => 'active',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addWeeks(2)->format('Y-m-d'),
        ]);

        CommissionRule::create([
            'commission_id' => $vendorCommission->id,
            'applies_to' => 'vendor',
            'applies_id' => 5,
            'condition' => json_encode(['vendor' => 'VIP']),
            'priority' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Example product-specific commission
        $productCommission = Commission::create([
            'name' => 'Special Product Commission',
            'type' => 'product',
            'rate' => 12,
            'rate_type' => 'percentage',
            'status' => 'active',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addWeeks(2)->format('Y-m-d'),
        ]);

        CommissionRule::create([
            'commission_id' => $productCommission->id,
            'applies_to' => 'product',
            'applies_id' => 5,
            'condition' => json_encode(['sku_tag' => 'VIP']),
            'priority' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
