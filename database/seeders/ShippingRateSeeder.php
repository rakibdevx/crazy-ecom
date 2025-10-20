<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingRateSeeder extends Seeder
{
    public function run()
    {
        $vendors = DB::table('vendors')->pluck('id'); // সব vendor
        $zones = DB::table('shipping_zones')->pluck('id'); // সব zone

        foreach ($zones as $zoneId) {
            DB::table('shipping_rates')->insert([
                'shipping_zone_id' => $zoneId,
                'vendor_id' => null,
                'cost' => rand(50, 200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        foreach ($vendors as $vendorId) {
            foreach ($zones as $zoneId) {
                DB::table('shipping_rates')->insert([
                    'shipping_zone_id' => $zoneId,
                    'vendor_id' => $vendorId,
                    'cost' => rand(100, 500),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
