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
        User::factory(10)->create();
        Vendor::factory(10)->create();
        $this->call([
            TimeZoneSeeder::class,
            SettingSeeder::class,
            VendorSeeder::class,
            UserSeeder::class,
            MailTemplatesSeeder::class,
            DateTimeFormatSeeder::class,
            PermissionSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            ChildCategorySeeder::class,
            BrandSeeder::class,
            SizesTableSeeder::class,
            ColorsTableSeeder::class,
            CommissionSeeder::class,
            ShippingRateSeeder::class,
            ShippingZoneSeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
            CommentSeeder::class,
        ]);
    }
}






