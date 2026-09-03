<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,

            TempleSeeder::class,

            RolePermissionSeeder::class,

            AdminUserSeeder::class,

            ProjectSeeder::class,

            CampaignSeeder::class,

            WebsiteContentSeeder::class,
        ]);
    }
}
