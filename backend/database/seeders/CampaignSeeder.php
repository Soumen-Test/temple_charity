<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $organization = Organization::where(
            'short_name',
            'TCF'
        )->firstOrFail();

        $projects = Project::where(
            'organization_id',
            $organization->id
        )->get()
        ->keyBy('project_code');

        $campaigns = [
            [
                'project_code' => 'PRJ-FOOD-001',

                'name' =>
                    'আগস্ট ২০২৬ — এক বেলার আহার',

                'slug' =>
                    'august-2026-one-meal-food',

                'campaign_code' =>
                    'CMP-FOOD-2026-08',

                'target_amount' =>
                    120000,

                'short_description' =>
                    '১,০০০ জন মানুষের জন্য এক বেলার খাবার।',
            ],

            [
                'project_code' => 'PRJ-SNACK-001',

                'name' =>
                    'আগস্ট ২০২৬ — শিক্ষার্থীদের নাস্তা',

                'slug' =>
                    'august-2026-student-snack',

                'campaign_code' =>
                    'CMP-SNACK-2026-08',

                'target_amount' =>
                    60000,

                'short_description' =>
                    'গীতা শিক্ষা কেন্দ্রের শিক্ষার্থীদের নাস্তা।',
            ],

            [
                'project_code' => 'PRJ-GITA-001',

                'name' =>
                    'গীতা দান — ২০২৬',

                'slug' =>
                    'gita-distribution-2026',

                'campaign_code' =>
                    'CMP-GITA-2026',

                'target_amount' =>
                    100000,

                'short_description' =>
                    '৫০০টি গীতা বিতরণের উদ্যোগ।',
            ],

            [
                'project_code' => 'PRJ-EDU-001',

                'name' =>
                    'শিক্ষা সামগ্রী বিতরণ — ২০২৬',

                'slug' =>
                    'education-material-2026',

                'campaign_code' =>
                    'CMP-EDU-2026',

                'target_amount' =>
                    150000,

                'short_description' =>
                    'শিক্ষার্থীদের শিক্ষা সামগ্রী প্রদান।',
            ],

            [
                'project_code' => 'PRJ-SCHOLARSHIP-001',

                'name' =>
                    'শিক্ষা বৃত্তি — ২০২৬',

                'slug' =>
                    'education-scholarship-2026',

                'campaign_code' =>
                    'CMP-SCHOLARSHIP-2026',

                'target_amount' =>
                    300000,

                'short_description' =>
                    'যোগ্য শিক্ষার্থীদের শিক্ষা সহায়তা।',
            ],
        ];

        foreach ($campaigns as $campaignData) {

            $project = $projects->get(
                $campaignData['project_code']
            );

            if (!$project) {
                continue;
            }

            Campaign::updateOrCreate(
                [
                    'project_id' =>
                        $project->id,

                    'campaign_code' =>
                        $campaignData['campaign_code'],
                ],
                [
                    'uuid' =>
                        (string) Str::uuid(),

                    'name' =>
                        $campaignData['name'],

                    'slug' =>
                        $campaignData['slug'],

                    'short_description' =>
                        $campaignData['short_description'],

                    'description' =>
                        $campaignData['short_description'],

                    'target_amount' =>
                        $campaignData['target_amount'],

                    'start_date' =>
                        now()->toDateString(),

                    'end_date' =>
                        now()->addYear()->toDateString(),

                    'is_public' => true,

                    'is_featured' => false,

                    'status' => 'active',
                ]
            );
        }
    }
}