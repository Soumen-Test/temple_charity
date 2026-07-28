<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Project;
use App\Models\Temple;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $organization = Organization::where(
            'short_name',
            'TCF'
        )->firstOrFail();

        $temple = Temple::where(
            'organization_id',
            $organization->id
        )->first();

        $projects = [

            [
                'name' => 'এক বেলার আহার কর্মসূচি',

                'slug' => 'one-meal-food-program',

                'project_code' => 'PRJ-FOOD-001',

                'project_type' => 'Food Distribution',

                'short_description' =>
                    'প্রয়োজনীয় মানুষের জন্য এক বেলার খাবার বিতরণ।',

                'description' =>
                    'এই প্রকল্পের মাধ্যমে প্রয়োজনীয় মানুষ ও শিশুদের জন্য নিয়মিত এক বেলার খাবার বিতরণ করা হবে।',

                'target_amount' => 120000,

                'target_beneficiaries' => 1000,

                'is_featured' => true,
            ],

            [
                'name' => 'গীতা শিক্ষা কেন্দ্রের শিক্ষার্থীদের নাস্তা',

                'slug' => 'gita-education-snack-program',

                'project_code' => 'PRJ-SNACK-001',

                'project_type' => 'Student Welfare',

                'short_description' =>
                    'গীতা শিক্ষা কেন্দ্রের শিক্ষার্থীদের জন্য নিয়মিত নাস্তা।',

                'description' =>
                    'গীতা শিক্ষা কেন্দ্রের শিক্ষার্থীদের নিয়মিত পুষ্টিকর নাস্তা প্রদান।',

                'target_amount' => 60000,

                'target_beneficiaries' => 100,

                'is_featured' => false,
            ],

            [
                'name' => 'গীতা দান কর্মসূচি',

                'slug' => 'gita-distribution-program',

                'project_code' => 'PRJ-GITA-001',

                'project_type' => 'Religious Education',

                'short_description' =>
                    'মানুষের মধ্যে শ্রীমদ্ভগবদ্গীতা বিতরণ।',

                'description' =>
                    'আধ্যাত্মিক ও নৈতিক শিক্ষার প্রসারের জন্য শ্রীমদ্ভগবদ্গীতা বিতরণ।',

                'target_amount' => 100000,

                'target_beneficiaries' => 500,

                'is_featured' => false,
            ],

            [
                'name' => 'শিক্ষা সামগ্রী বিতরণ',

                'slug' => 'education-material-distribution',

                'project_code' => 'PRJ-EDU-001',

                'project_type' => 'Education Support',

                'short_description' =>
                    'প্রয়োজনীয় শিক্ষার্থীদের শিক্ষা সামগ্রী প্রদান।',

                'description' =>
                    'খাতা, কলম, ব্যাগ, ইউনিফর্ম ও বই বিতরণের মাধ্যমে শিক্ষার্থীদের সহায়তা করা।',

                'target_amount' => 150000,

                'target_beneficiaries' => 300,

                'is_featured' => true,
            ],

            [
                'name' => 'শিক্ষা বৃত্তি',

                'slug' => 'education-scholarship',

                'project_code' => 'PRJ-SCHOLARSHIP-001',

                'project_type' => 'Scholarship',

                'short_description' =>
                    'মেধাবী ও আর্থিকভাবে অসচ্ছল শিক্ষার্থীদের বৃত্তি।',

                'description' =>
                    'যোগ্য শিক্ষার্থীদের শিক্ষার ধারাবাহিকতা বজায় রাখতে আর্থিক সহায়তা প্রদান।',

                'target_amount' => 300000,

                'target_beneficiaries' => 50,

                'is_featured' => true,
            ],

        ];

        foreach ($projects as $projectData) {

            Project::updateOrCreate(
                [
                    'organization_id' =>
                        $organization->id,

                    'project_code' =>
                        $projectData['project_code'],
                ],

                [

                    'uuid' => (string) Str::uuid(),

                    'temple_id' =>
                        $temple?->id,

                    'name' =>
                        $projectData['name'],

                    'slug' =>
                        $projectData['slug'],

                    'project_type' =>
                        $projectData['project_type'],

                    'short_description' =>
                        $projectData['short_description'],

                    'description' =>
                        $projectData['description'],

                    'target_amount' =>
                        $projectData['target_amount'],

                    'target_beneficiaries' =>
                        $projectData['target_beneficiaries'],

                    'start_date' =>
                        now()->toDateString(),

                    'end_date' =>
                        now()->addYear()->toDateString(),

                    'is_public' => true,

                    'is_featured' =>
                        $projectData['is_featured'],

                    'status' => 'active',
                ]
            );
        }
    }
}   