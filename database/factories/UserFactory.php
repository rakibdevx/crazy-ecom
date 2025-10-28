<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;
    protected static $profileImageCounter = 1;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'phone' => $this->faker->phoneNumber,
            'profile_image' => 'demo/user_' . self::$profileImageCounter++ . '.jpg',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
