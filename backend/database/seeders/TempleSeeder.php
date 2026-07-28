<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Temple;
use Illuminate\Database\Seeder;

class TempleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = Organization::where(
            'short_name',
            'TCF'
        )->firstOrFail();

        Temple::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'code' => 'TEM-001',
            ],
            [
                'uuid' => \Illuminate\Support\Str::uuid(),

                'name' => 'Main Temple',

                'description' => 'Main temple and charity activity center.',

                'priest_name' => null,

                'priest_mobile' => null,

                'email' => null,

                'phone' => null,

                'address' => 'Chattogram, Bangladesh',

                'country' => 'Bangladesh',

                'district' => 'Chattogram',

                'division' => 'Chattogram',

                'latitude' => null,

                'longitude' => null,

                'google_map_url' => null,

                'established_date' => null,

                'logo_path' => null,

                'is_active' => true,

                'remarks' => null,
            ]
        );
    }
}