<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ['category_id' => 1, 'name' => 'Mobile Phones'],
            ['category_id' => 1, 'name' => 'Laptops'],
            ['category_id' => 2, 'name' => 'Men Clothing'],
            ['category_id' => 2, 'name' => 'Women Clothing'],
            ['category_id' => 3, 'name' => 'Furniture'],
            ['category_id' => 3, 'name' => 'Kitchen Appliances'],
            ['category_id' => 4, 'name' => 'Fiction'],
            ['category_id' => 4, 'name' => 'Non-Fiction'],
            ['category_id' => 5, 'name' => 'Action Figures'],
            ['category_id' => 5, 'name' => 'Board Games'],
            ['category_id' => 6, 'name' => 'Fitness Equipment'],
            ['category_id' => 6, 'name' => 'Sportswear'],
            ['category_id' => 7, 'name' => 'Skincare'],
            ['category_id' => 7, 'name' => 'Makeup'],
            ['category_id' => 8, 'name' => 'Car Accessories'],
            ['category_id' => 8, 'name' => 'Motorbike Accessories'],
            ['category_id' => 9, 'name' => 'Fruits & Vegetables'],
            ['category_id' => 9, 'name' => 'Beverages'],
            ['category_id' => 10, 'name' => 'Supplements'],
            ['category_id' => 10, 'name' => 'Medical Supplies']
        ];

        foreach ($subcategories as $sub) {
            DB::table('sub_categories')->insert([
                'category_id' => $sub['category_id'],
                'name' => $sub['name'],
                'slug' => Str::slug($sub['name']),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
