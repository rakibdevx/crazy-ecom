<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'phone' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'company_website' => $this->faker->url,
            'status' => 'active',
            'verified' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
