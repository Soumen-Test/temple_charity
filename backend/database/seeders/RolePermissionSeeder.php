<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'dashboard.view',

            'organization.view',
            'organization.create',
            'organization.update',
            'organization.delete',

            'temple.view',
            'temple.create',
            'temple.update',
            'temple.delete',

            'user.view',
            'user.create',
            'user.update',
            'user.delete',

            'role.view',
            'role.create',
            'role.update',
            'role.delete',

            'project.view',
            'project.create',
            'project.update',
            'project.delete',

            'donation.view',
            'donation.create',
            'donation.update',

            'expense.view',
            'expense.create',
            'expense.update',
            'expense.delete',

            'report.view',
            'report.export',

            'settings.view',
            'settings.update',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $organizationAdmin = Role::firstOrCreate([
            'name' => 'Organization Admin',
            'guard_name' => 'web',
        ]);

        $templeAdmin = Role::firstOrCreate([
            'name' => 'Temple Admin',
            'guard_name' => 'web',
        ]);

        $accountant = Role::firstOrCreate([
            'name' => 'Accountant',
            'guard_name' => 'web',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions
        |--------------------------------------------------------------------------
        */

        $superAdmin->syncPermissions(
            Permission::all()
        );

        $organizationAdmin->syncPermissions([
            'dashboard.view',

            'organization.view',
            'organization.update',

            'temple.view',
            'temple.create',
            'temple.update',

            'user.view',

            'project.view',
            'project.create',
            'project.update',

            'donation.view',

            'expense.view',
            'expense.create',
            'expense.update',

            'report.view',
            'report.export',
        ]);

        $templeAdmin->syncPermissions([
            'dashboard.view',

            'temple.view',
            'temple.update',

            'project.view',
            'donation.view',

            'expense.view',
            'expense.create',

            'report.view',
        ]);

        $accountant->syncPermissions([
            'dashboard.view',

            'donation.view',

            'expense.view',
            'expense.create',
            'expense.update',

            'report.view',
            'report.export',
        ]);
    }
}