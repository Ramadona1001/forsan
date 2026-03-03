<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            'super_admin',
            'admin',
            'horse_owner',
            'stable_owner',
            'store_owner',
            'trainer',
            'veterinarian',
            'customer',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create super admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@knights.com'],
            [
                'name' => 'مسؤول النظام',
                'password' => Hash::make('password'),
                'type' => UserType::ADMIN,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('super_admin');

        $this->command->info('Roles and admin user created successfully!');
    }
}
