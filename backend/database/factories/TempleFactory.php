<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Temple;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Temple>
 */
class TempleFactory extends Factory
{
    protected $model = Temple::class;

    public function definition(): array
    {
        return [
            'organization_id' => Organization::factory(),

            'name' => fake()->company() . ' Temple',

            'code' => 'TEM-' . fake()->unique()->numberBetween(1000, 9999),

            'description' => fake()->paragraph(),

            'priest_name' => fake()->name(),

            'priest_mobile' => '017' . fake()->numerify('########'),

            'email' => fake()->unique()->safeEmail(),

            'phone' => '017' . fake()->numerify('########'),

            'address' => fake()->address(),

            'country' => 'Bangladesh',

            'district' => 'Chattogram',

            'division' => 'Chattogram',

            'latitude' => 22.3569,

            'longitude' => 91.7832,

            'google_map_url' => null,

            'established_date' => fake()->date(),

            'logo_path' => null,

            'is_active' => true,

            'created_by' => null,

            'updated_by' => null,

            'remarks' => null,
        ];
    }
}