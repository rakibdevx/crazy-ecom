<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TimeZoneSeeder::class,
            SettingSeeder::class,
            AdminSeeder::class,
            VendorSeeder::class,
            UserSeeder::class,
            MailTemplatesSeeder::class,
        ]);
        User::factory(1000)->create();
        Vendor::factory(1000)->create();
    }
}
