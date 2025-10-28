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
            // 1. Electronics
            ['category_id' => 1, 'name' => 'Mobile Phones'],
            ['category_id' => 1, 'name' => 'Laptops'],
            ['category_id' => 1, 'name' => 'Cameras'],
            ['category_id' => 1, 'name' => 'Televisions'],
            ['category_id' => 1, 'name' => 'Headphones'],

            // 2. Fashion
            ['category_id' => 2, 'name' => 'Men Clothing'],
            ['category_id' => 2, 'name' => 'Women Clothing'],
            ['category_id' => 2, 'name' => 'Accessories'],
            ['category_id' => 2, 'name' => 'Bags'],

            // 3. Home & Kitchen
            ['category_id' => 3, 'name' => 'Furniture'],
            ['category_id' => 3, 'name' => 'Kitchen Appliances'],
            ['category_id' => 3, 'name' => 'Home Decor'],
            ['category_id' => 3, 'name' => 'Cookware'],
            ['category_id' => 3, 'name' => 'Lighting'],

            // 4. Books
            ['category_id' => 4, 'name' => 'Fiction'],
            ['category_id' => 4, 'name' => 'Non-Fiction'],
            ['category_id' => 4, 'name' => 'Comics'],
            ['category_id' => 4, 'name' => 'Educational'],
            ['category_id' => 4, 'name' => 'Children Books'],

            // 5. Toys
            ['category_id' => 5, 'name' => 'Action Figures'],
            ['category_id' => 5, 'name' => 'Board Games'],
            ['category_id' => 5, 'name' => 'Dolls'],
            ['category_id' => 5, 'name' => 'Building Blocks'],
            ['category_id' => 5, 'name' => 'Outdoor Toys'],

            // 6. Sports
            ['category_id' => 6, 'name' => 'Fitness Equipment'],
            ['category_id' => 6, 'name' => 'Sportswear'],
            ['category_id' => 6, 'name' => 'Footwear'],
            ['category_id' => 6, 'name' => 'Outdoor Sports'],
            ['category_id' => 6, 'name' => 'Indoor Games'],

            // 7. Beauty
            ['category_id' => 7, 'name' => 'Skincare'],
            ['category_id' => 7, 'name' => 'Makeup'],
            ['category_id' => 7, 'name' => 'Haircare'],
            ['category_id' => 7, 'name' => 'Fragrance'],
            ['category_id' => 7, 'name' => 'Personal Care'],

            // 8. Automotive
            ['category_id' => 8, 'name' => 'Car Accessories'],
            ['category_id' => 8, 'name' => 'Motorbike Accessories'],
            ['category_id' => 8, 'name' => 'Car Parts'],
            ['category_id' => 8, 'name' => 'Tires & Wheels'],
            ['category_id' => 8, 'name' => 'Car Electronics'],

            // 9. Groceries
            ['category_id' => 9, 'name' => 'Fruits & Vegetables'],
            ['category_id' => 9, 'name' => 'Beverages'],
            ['category_id' => 9, 'name' => 'Snacks'],
            ['category_id' => 9, 'name' => 'Cooking Essentials'],
            ['category_id' => 9, 'name' => 'Dairy Products'],

            // 10. Health
            ['category_id' => 10, 'name' => 'Supplements'],
            ['category_id' => 10, 'name' => 'Medical Supplies'],
            ['category_id' => 10, 'name' => 'Healthcare Devices'],
            ['category_id' => 10, 'name' => 'First Aid'],
            ['category_id' => 10, 'name' => 'Personal Hygiene'],

            // 11. Music
            ['category_id' => 11, 'name' => 'Instruments'],
            ['category_id' => 11, 'name' => 'Vinyl Records'],
            ['category_id' => 11, 'name' => 'Music Accessories'],
            ['category_id' => 11, 'name' => 'Speakers'],
            ['category_id' => 11, 'name' => 'Microphones'],

            // 12. Movies
            ['category_id' => 12, 'name' => 'DVDs'],
            ['category_id' => 12, 'name' => 'Blu-ray'],
            ['category_id' => 12, 'name' => 'Posters'],
            ['category_id' => 12, 'name' => 'Merchandise'],
            ['category_id' => 12, 'name' => 'Collectibles'],

            // 13. Garden
            ['category_id' => 13, 'name' => 'Plants'],
            ['category_id' => 13, 'name' => 'Gardening Tools'],
            ['category_id' => 13, 'name' => 'Soil & Fertilizer'],
            ['category_id' => 13, 'name' => 'Outdoor Furniture'],
            ['category_id' => 13, 'name' => 'Planters'],

            // 14. Office Supplies
            ['category_id' => 14, 'name' => 'Stationery'],
            ['category_id' => 14, 'name' => 'Printers'],
            ['category_id' => 14, 'name' => 'Office Furniture'],
            ['category_id' => 14, 'name' => 'Storage'],
            ['category_id' => 14, 'name' => 'Paper Products'],

            // 15. Jewelry
            ['category_id' => 15, 'name' => 'Necklaces'],
            ['category_id' => 15, 'name' => 'Earrings'],
            ['category_id' => 15, 'name' => 'Rings'],
            ['category_id' => 15, 'name' => 'Bracelets'],
            ['category_id' => 15, 'name' => 'Watches'],

            // 16. Pet Supplies
            ['category_id' => 16, 'name' => 'Pet Food'],
            ['category_id' => 16, 'name' => 'Pet Toys'],
            ['category_id' => 16, 'name' => 'Pet Grooming'],
            ['category_id' => 16, 'name' => 'Pet Beds'],
            ['category_id' => 16, 'name' => 'Aquarium Supplies'],

            // 17. Baby Products
            ['category_id' => 17, 'name' => 'Diapers'],
            ['category_id' => 17, 'name' => 'Baby Clothing'],
            ['category_id' => 17, 'name' => 'Toys'],
            ['category_id' => 17, 'name' => 'Feeding'],
            ['category_id' => 17, 'name' => 'Baby Care'],

            // 18. Shoes
            ['category_id' => 18, 'name' => 'Men Shoes'],
            ['category_id' => 18, 'name' => 'Women Shoes'],
            ['category_id' => 18, 'name' => 'Sports Shoes'],
            ['category_id' => 18, 'name' => 'Casual Shoes'],
            ['category_id' => 18, 'name' => 'Formal Shoes'],

            // 19. Tools
            ['category_id' => 19, 'name' => 'Power Tools'],
            ['category_id' => 19, 'name' => 'Hand Tools'],
            ['category_id' => 19, 'name' => 'Tool Storage'],
            ['category_id' => 19, 'name' => 'Safety Equipment'],
            ['category_id' => 19, 'name' => 'Measuring Tools'],

            // 20. Travel
            ['category_id' => 20, 'name' => 'Luggage'],
            ['category_id' => 20, 'name' => 'Travel Accessories'],
            ['category_id' => 20, 'name' => 'Backpacks'],
            ['category_id' => 20, 'name' => 'Camping Gear'],
            ['category_id' => 20, 'name' => 'Travel Gadgets'],
        ];

        $counter = 1;
        foreach ($subcategories as $sub) {
            DB::table('sub_categories')->insert([
                'category_id' => $sub['category_id'],
                'name' => $sub['name'],
                'slug' => Str::slug($sub['name']),
                'status' => 'active',
                'image' => 'demo/sub_category_' . $counter . '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $counter++;
        }
    }
}
