<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Demo Customer',
            'username' => 'demouser',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'phone' => '01730000000',
            'status' => 'active',
        ]);
    }
}
