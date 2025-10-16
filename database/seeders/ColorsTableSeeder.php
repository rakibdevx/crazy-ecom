<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $colors = [
            ['name' => 'Red', 'code' => '#FF0000'],
            ['name' => 'Blue', 'code' => '#0000FF'],
            ['name' => 'Green', 'code' => '#00FF00'],
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#FFFFFF'],
            ['name' => 'Yellow', 'code' => '#FFFF00'],
            ['name' => 'Orange', 'code' => '#FFA500'],
            ['name' => 'Purple', 'code' => '#800080'],
            ['name' => 'Pink', 'code' => '#FFC0CB'],
            ['name' => 'Gray', 'code' => '#808080'],
            ['name' => 'Brown', 'code' => '#A52A2A'],
            ['name' => 'Cyan', 'code' => '#00FFFF'],
            ['name' => 'Magenta', 'code' => '#FF00FF'],
            ['name' => 'Lime', 'code' => '#00FF00'],
            ['name' => 'Maroon', 'code' => '#800000'],
            ['name' => 'Navy', 'code' => '#000080'],
            ['name' => 'Olive', 'code' => '#808000'],
            ['name' => 'Teal', 'code' => '#008080'],
            ['name' => 'Silver', 'code' => '#C0C0C0'],
            ['name' => 'Gold', 'code' => '#FFD700'],
            ['name' => 'Beige', 'code' => '#F5F5DC'],
            ['name' => 'Coral', 'code' => '#FF7F50'],
            ['name' => 'Turquoise', 'code' => '#40E0D0'],
            ['name' => 'Indigo', 'code' => '#4B0082'],
            ['name' => 'Violet', 'code' => '#EE82EE'],
            ['name' => 'Salmon', 'code' => '#FA8072'],
            ['name' => 'Chocolate', 'code' => '#D2691E'],
            ['name' => 'Crimson', 'code' => '#DC143C'],
            ['name' => 'Khaki', 'code' => '#F0E68C'],
            ['name' => 'Lavender', 'code' => '#E6E6FA'],
            ['name' => 'Plum', 'code' => '#DDA0DD'],
            ['name' => 'Mint', 'code' => '#98FF98'],
            ['name' => 'Peach', 'code' => '#FFE5B4'],
            ['name' => 'Sky Blue', 'code' => '#87CEEB'],
            ['name' => 'Sea Green', 'code' => '#2E8B57'],
            ['name' => 'Dark Gray', 'code' => '#A9A9A9'],
            ['name' => 'Light Gray', 'code' => '#D3D3D3'],
            ['name' => 'Rose', 'code' => '#FF007F'],
        ];

        foreach ($colors as $color) {
            DB::table('colors')->insert([
                'name' => $color['name'],
                'slug' => Str::slug($color['name']),
                'code' => $color['code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
