<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics', 'Fashion', 'Home & Kitchen', 'Books', 'Toys',
            'Sports', 'Beauty', 'Automotive', 'Groceries', 'Health',
            'Music', 'Movies', 'Garden', 'Office Supplies', 'Jewelry',
            'Pet Supplies', 'Baby Products', 'Shoes', 'Tools', 'Travel'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => 'images/categories/' . Str::slug($category) . '.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
