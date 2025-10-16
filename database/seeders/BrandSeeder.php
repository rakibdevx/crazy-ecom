<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Nike','Adidas','Samsung','Apple','Sony',
            'LG','Puma','Reebok','Dell','HP',
            'Canon','Logitech','Microsoft','Asus','Intel',
            'Bosch','Panasonic','Philips','Lenovo','Huawei'
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'image_path' => 'images/brands/' . Str::slug($brand) . '.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
