<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Organization>
 */
class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'name' => 'Temple Charity Foundation',

            'short_name' => 'TCF',

            'registration_no' => 'TCF-' . fake()->unique()->numberBetween(1000, 9999),

            'email' => 'info@templecharity.org',

            'phone' => '+8801700000000',

            'website' => 'https://templecharity.org',

            'address' => 'Chattogram, Bangladesh',

            'country' => 'Bangladesh',

            'district' => 'Chattogram',

            'division' => 'Chattogram',

            'is_active' => true,

            'remarks' => 'Primary charity organization',
        ];
    }
}