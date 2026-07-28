<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@templecharity.test',
            ],
            [
                'name' => 'Super Admin',

                'password' => 'password',

                'is_active' => true,
            ]
        );

        $admin = User::updateOrCreate(
            [
                'email' => 'admin@templecharity.test',
            ],
            [
                'name' => 'Super Admin',

                'password' => 'password',

                'is_active' => true,
            ]
        );

        $admin->assignRole('Super Admin');
    }
}