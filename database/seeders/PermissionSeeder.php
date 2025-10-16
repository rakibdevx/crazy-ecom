<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // General Settings
            'General-setting',
            'Seo-setting',
            'Contact-setting',
            'Mail-setting',
            'System-setting',
            'Security-setting',
            'Config-setting',
            'Image-setting',
            'Clear-cache',

            // MailTemptale Management
            'MailTemplate-view',
            'MailTemplate-edit',

            // Admin Management
            'Admin-view',
            'Admin-create',
            'Admin-edit',
            'Admin-delete',
            'Admin-login',

            // Vendor Management
            'Vendor-view',
            'Vendor-create',
            'Vendor-edit',
            'Vendor-delete',
            'Vendor-verify',
            'Vendor-login',

            // User Management
            'User-view',
            'User-create',
            'User-edit',
            'User-delete',
            'User-verify',
            'User-login',

            // Role Management
            'Role-view',
            'Role-create',
            'Role-edit',
            'Role-delete',

            // Permission Management
            'Permission-view',
            'Permission-create',
            'Permission-edit',
            'Permission-delete',

            // Category Management
            'Category-view',
            'Category-create',
            'Category-edit',
            'Category-delete',

            //Sub Category Management
            'Sub-category-view',
            'Sub-category-create',
            'Sub-category-edit',
            'Sub-category-delete',

            //Child Category Management
            'Child-category-view',
            'Child-category-create',
            'Child-category-edit',
            'Child-category-delete',

            // Category Management
            'Brand-view',
            'Brand-create',
            'Brand-edit',
            'Brand-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin',
        ]);

        $this->command->info('Permissions seeded successfully!');
    }
}
