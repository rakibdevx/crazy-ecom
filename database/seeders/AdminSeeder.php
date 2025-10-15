<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '01710000000',
            'status' => 'active',
        ]);

        $admin->assignRole('Super Admin');
        
        $this->command->info('Admin seeded successfully!');
    }
}
