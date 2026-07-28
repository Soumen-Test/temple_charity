<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Campaign>
 */
class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        $name = fake()->sentence(4);

        return [
            'uuid' => (string) Str::uuid(),

            'project_id' => Project::factory(),

            'name' => $name,

            'slug' => Str::slug($name),

            'campaign_code' =>
                'CMP-' . fake()->unique()->numberBetween(1000, 9999),

            'short_description' =>
                fake()->sentence(),

            'description' =>
                fake()->paragraphs(2, true),

            'target_amount' =>
                fake()->randomFloat(
                    2,
                    50000,
                    500000
                ),

            'start_date' =>
                now()->toDateString(),

            'end_date' =>
                now()->addMonths(3)->toDateString(),

            'is_public' => true,

            'is_featured' => false,

            'status' => 'active',

            'created_by' => null,

            'updated_by' => null,
        ];
    }
}