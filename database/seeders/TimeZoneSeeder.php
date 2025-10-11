<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeZoneSeeder extends Seeder
{
    public function run(): void
    {
        $time_zones = [
            ['name' => 'UTC', 'offset' => '+00:00'],
            ['name' => 'Asia/Dhaka', 'offset' => '+06:00'],
            ['name' => 'Asia/Kolkata', 'offset' => '+05:30'],
            ['name' => 'Asia/Singapore', 'offset' => '+08:00'],
            ['name' => 'Asia/Tokyo', 'offset' => '+09:00'],
            ['name' => 'Asia/Dubai', 'offset' => '+04:00'],
            ['name' => 'Europe/London', 'offset' => '+00:00'],
            ['name' => 'Europe/Paris', 'offset' => '+01:00'],
            ['name' => 'Europe/Berlin', 'offset' => '+01:00'],
            ['name' => 'Europe/Moscow', 'offset' => '+03:00'],
            ['name' => 'America/New_York', 'offset' => '-05:00'],
            ['name' => 'America/Los_Angeles', 'offset' => '-08:00'],
            ['name' => 'America/Chicago', 'offset' => '-06:00'],
            ['name' => 'America/Toronto', 'offset' => '-05:00'],
            ['name' => 'America/Mexico_City', 'offset' => '-06:00'],
            ['name' => 'Australia/Sydney', 'offset' => '+10:00'],
            ['name' => 'Australia/Melbourne', 'offset' => '+10:00'],
            ['name' => 'Africa/Cairo', 'offset' => '+02:00'],
            ['name' => 'Africa/Nairobi', 'offset' => '+03:00'],
            ['name' => 'Pacific/Auckland', 'offset' => '+12:00'],
            ['name' => 'Pacific/Honolulu', 'offset' => '-10:00'],
        ];

        DB::table('time_zones')->insert($time_zones);
    }
}
