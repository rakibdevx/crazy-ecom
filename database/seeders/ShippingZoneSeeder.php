<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingZoneSeeder extends Seeder
{
    public function run()
    {
        $zones = [
            'North Zone', 'South Zone', 'East Zone', 'West Zone', 'Central Zone',
            'Zone 1', 'Zone 2', 'Zone 3', 'Zone 4', 'Zone 5',
            'Zone 6', 'Zone 7', 'Zone 8', 'Zone 9', 'Zone 10',
            'Zone 11', 'Zone 12', 'Zone 13', 'Zone 14', 'Zone 15',
            'Zone 16', 'Zone 17', 'Zone 18', 'Zone 19', 'Zone 20',
            'Zone 21', 'Zone 22', 'Zone 23', 'Zone 24', 'Zone 25',
            'Zone 26', 'Zone 27', 'Zone 28', 'Zone 29', 'Zone 30',
            'Zone 31', 'Zone 32', 'Zone 33', 'Zone 34', 'Zone 35',
            'Zone 36', 'Zone 37', 'Zone 38', 'Zone 39', 'Zone 40',
            'Zone 41', 'Zone 42', 'Zone 43', 'Zone 44', 'Zone 45',
        ];

        foreach ($zones as $zone) {
            DB::table('shipping_zones')->insert([
                'name' => $zone,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
