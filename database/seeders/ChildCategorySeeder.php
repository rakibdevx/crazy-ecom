<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $childCategories = [
            ['sub_categories_id' => 1, 'name' => 'Android Phones'],
            ['sub_categories_id' => 1, 'name' => 'iPhones'],
            ['sub_categories_id' => 2, 'name' => 'Gaming Laptops'],
            ['sub_categories_id' => 2, 'name' => 'Ultrabooks'],
            ['sub_categories_id' => 3, 'name' => 'Shirts'],
            ['sub_categories_id' => 3, 'name' => 'Trousers'],
            ['sub_categories_id' => 4, 'name' => 'Dresses'],
            ['sub_categories_id' => 4, 'name' => 'Skirts'],
            ['sub_categories_id' => 5, 'name' => 'Superheroes'],
            ['sub_categories_id' => 5, 'name' => 'Vehicles'],
            ['sub_categories_id' => 6, 'name' => 'Treadmills'],
            ['sub_categories_id' => 6, 'name' => 'Dumbbells'],
            ['sub_categories_id' => 7, 'name' => 'Face Creams'],
            ['sub_categories_id' => 7, 'name' => 'Lipsticks'],
            ['sub_categories_id' => 8, 'name' => 'Seat Covers'],
            ['sub_categories_id' => 8, 'name' => 'Helmet'],
            ['sub_categories_id' => 9, 'name' => 'Fresh Fruits'],
            ['sub_categories_id' => 9, 'name' => 'Juices'],
            ['sub_categories_id' => 10, 'name' => 'Vitamins'],
            ['sub_categories_id' => 10, 'name' => 'First Aid Kits']
        ];

        foreach ($childCategories as $child) {
            DB::table('child_categories')->insert([
                'sub_categories_id' => $child['sub_categories_id'],
                'name' => $child['name'],
                'slug' => Str::slug($child['name']),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
