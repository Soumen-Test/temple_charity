<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::firstOrCreate(
            [
                'short_name' => 'TCF',
            ],
            [
                'name' => 'Temple Charity Foundation',

                'registration_no' => 'TCF-0001',

                'email' => 'info@templecharity.org',

                'phone' => '+8801700000000',

                'website' => 'https://templecharity.org',

                'address' => 'Chattogram, Bangladesh',

                'country' => 'Bangladesh',

                'district' => 'Chattogram',

                'division' => 'Chattogram',

                'is_active' => true,

                'remarks' => 'Primary charity organization',
            ]
        );
    }
}