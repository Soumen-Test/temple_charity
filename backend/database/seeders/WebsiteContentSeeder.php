<?php

namespace Database\Seeders;

use App\Models\WebsiteContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $content = [
            'heading' => 'Vogoban Help Those Who Help Themselves',
            'vision' => [
                'title' => 'Our Vision',
                'description' => 'Lorem ipsum dolor sit amet tetur nod elit sed',
            ],
            'mission' => [
                'title' => 'Our Mission',
                'description' => 'Lorem ipsum dolor sit amet tetur nod elit sed',
            ],
            'highlight_text' => 'Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis aliquam. Etiam quis mauris justo.',
            'raised_amount' => '$20,46',
            'raised_label' => 'Raised',
            'features' => [
                'Charity & Donation',
                'Parent Education',
                'Bhagavad Gita Learning',
                'Temple Development',
            ],
            'callout_heading' => 'Every Hindu Should Understand the Spiritual Importance of Temples and Dharma',
            'callout_button_text' => 'Learn More',
            'callout_button_url' => '',
            // Each URL may be an absolute URL or a path served by the frontend.
            // A missing URL uses the component's built-in fallback image.
            'left_images' => [
                ['url' => null, 'alt' => 'Temple at sunset'],
                ['url' => null, 'alt' => 'Temple in rainy season'],
                ['url' => null, 'alt' => 'Temple activity'],
            ],
        ];

        WebsiteContent::updateOrCreate(
            [
                'organization_id' => 1,
                'temple_id' => 1,
                'content_key' => 'about.temple',
            ],
            [
                'uuid' => (string) Str::uuid(),
                'content_type' => 'json',
                'content_value' => json_encode($content, JSON_UNESCAPED_SLASHES),
                'title' => 'About THE Temple',
                'description' => 'Lorem ipsum dolor sit amet elit. Donec tempus eros vel dolor mattis aliquam. Etiam quis mauris justo. Vivamus purus nulla, rutrum ac risus in.',
                'is_public' => true,
                'is_active' => true,
                'sort_order' => 0,
            ]
        );
    }
}
