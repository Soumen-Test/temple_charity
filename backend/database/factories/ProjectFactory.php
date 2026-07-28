<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Project;
use App\Models\Temple;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $name = fake()->sentence(3);

        return [
            'uuid' => (string) Str::uuid(),

            'organization_id' => Organization::factory(),

            'temple_id' => null,

            'name' => $name,

            'slug' => Str::slug($name),

            'project_code' => 'PRJ-' . fake()->unique()->numberBetween(1000, 9999),

            'project_type' => 'General Charity',

            'short_description' => fake()->sentence(),

            'description' => fake()->paragraphs(2, true),

            'target_amount' => fake()->randomFloat(
                2,
                50000,
                1000000
            ),

            'target_beneficiaries' => fake()->numberBetween(
                50,
                5000
            ),

            'start_date' => now()->toDateString(),

            'end_date' => now()
                ->addMonths(6)
                ->toDateString(),

            'is_public' => true,

            'is_featured' => false,

            'status' => 'active',

            'created_by' => null,

            'updated_by' => null,
        ];
    }
}