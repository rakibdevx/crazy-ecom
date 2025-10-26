<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $colors = Color::pluck('id')->toArray();
        $sizes  = Size::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {

            $name = 'product '. $i;
            $slug = Str::slug($name);
            $sku  = Str::upper(Str::random(8));

            // Ensure unique slug
            $originalSlug = $slug;
            $count = 1;
            while(Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            // Ensure unique SKU
            $originalSku = $sku;
            $count = 1;
            while(Product::where('sku', $sku)->exists()) {
                $sku = $originalSku . '-' . $count;
                $count++;
            }

            $hasVariants = $faker->boolean(50);

            // Thumbnail
            $thumbnailFile = public_path('backend/images/product/thumbnail/dummy_' . rand(1,10) . '.jpg');
            if (!file_exists(dirname($thumbnailFile))) mkdir(dirname($thumbnailFile), 0777, true);

            $product = Product::create([
                'name' => $name,
                'slug' => $slug,
                'sku' => $sku,
                'barcode' => (string)$faker->unique()->randomNumber(8),
                'category_id' => $faker->numberBetween(1, 10),
                'sub_category_id' => $faker->numberBetween(1, 20),
                'child_category_id' => $faker->numberBetween(1, 20),
                'brand_id' => $faker->numberBetween(1, 5),
                'short_description' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'cost_price' => $faker->randomFloat(2, 10, 100),
                'sale_price' => $faker->randomFloat(2, 50, 200),
                'old_price'  => $faker->randomFloat(2, 10, 250),
                'stock_quantity' => $hasVariants ? 0 : $faker->numberBetween(10, 100),
                'has_variants' => $hasVariants,
                'trending'    => $faker->boolean(10) ? 'yes' : 'no',
                'featured'    => $faker->boolean(20) ? 'yes' : 'no',
                'new'         => $faker->boolean(30) ? 'yes' : 'no',
                'best_sell' => $faker->boolean(15) ? 'yes' : 'no',
                'shipping_type' => 'product',
                'shipping_cost' => $faker->randomFloat(2, 5, 20),
                'weight_kg' => $faker->randomFloat(2, 0.5, 5),
                'length_cm' => $faker->randomFloat(2, 10, 50),
                'width_cm' => $faker->randomFloat(2, 10, 50),
                'height_cm' => $faker->randomFloat(2, 5, 30),
                'tags' => json_encode($faker->words(3)),
                'thumbnail' => 'backend/images/product/thumbnail/dummy_' . rand(1,10) . '.jpg',
            ]);

            // Variants
            if ($hasVariants) {
                $variantCount = $faker->numberBetween(1, 3);
                for ($v = 0; $v < $variantCount; $v++) {
                    $product->variants()->create([
                        'color_id' => $faker->randomElement($colors),
                        'size_id' => $faker->randomElement($sizes),
                        'stock_quantity' => $faker->numberBetween(5, 50),
                        'price' => $faker->randomFloat(2, 50, 200),
                    ]);
                }
            } else {
                // Colors
                $colorCount = $faker->numberBetween(1, 3);
                foreach ($faker->randomElements($colors, $colorCount) as $colorId) {
                    $product->productColors()->create(['color_id' => $colorId]);
                }
                // Sizes
                $sizeCount = $faker->numberBetween(1, 3);
                foreach ($faker->randomElements($sizes, $sizeCount) as $sizeId) {
                    $product->productSizes()->create(['size_id' => $sizeId]);
                }
            }

            // Gallery Images
            $galleryCount = $faker->numberBetween(1, 4);
            for ($g = 0; $g < $galleryCount; $g++) {
                $product->gallery()->create([
                    'url' => 'backend/images/product/gallery/dummy_' . rand(1,10) . '.jpg',
                ]);
            }

            // Videos
            $videoCount = $faker->numberBetween(0, 2);
            for ($v = 0; $v < $videoCount; $v++) {
                $product->video()->create([
                    'url' => 'backend/videos/product/dummy_' . rand(1,5) . '.mp4',
                ]);
            }
        }
    }
}
