<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Big Sale is Live!',
                'subtitle' => 'Up to 50% off on selected products',
                'button_text' => 'Shop Now',
                'details' => 'products different adaptive your purpose shopping',
                'link' => 'https://example.com/shop',
                'image' => 'demo/slider_1.jpg',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'title' => 'New Arrivals',
                'subtitle' => 'Check out the latest fashion trends',
                'button_text' => 'Explore',
                'details' => 'products different adaptive your purpose shopping',
                'link' => 'https://example.com/new',
                'image' => 'demo/slider_2.jpg',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'title' => 'Exclusive Deals',
                'subtitle' => 'Hurry! Limited time offer',
                'button_text' => 'Grab Now',
                'details' => 'products different adaptive your purpose shopping',
                'link' => 'https://example.com/deals',
                'image' => null,
                'image' => 'demo/slider_3.jpg',
                'status' => 'active',
                'sort_order' => 3,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
