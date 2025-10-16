<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            // Clothes sizes
            'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL',
            // Shoe sizes
            '36', '37', '38', '39', '40', '41', '42', '43', '44'
        ];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'name' => $size,
                'slug' => Str::slug($size),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
