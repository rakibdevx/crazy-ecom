<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
use Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'name' => 'Demo Vendor',
            'username' => 'demovendor',
            'email' => 'vendor@example.com',
            'password' => Hash::make('password'),
            'phone' => '01720000000',
            'company_name' => 'Demo Company Ltd.',
            'status' => 'active',
            'verified' => true,
        ]);
    }
}
