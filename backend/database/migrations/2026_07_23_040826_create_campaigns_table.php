<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Public Identifier
            |--------------------------------------------------------------------------
            */

            $table->uuid('uuid')
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Project
            |--------------------------------------------------------------------------
            */

            $table->foreignId('project_id')
                ->constrained('projects')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Campaign Information
            |--------------------------------------------------------------------------
            */

            $table->string('name', 200);

            $table->string('slug', 255);

            $table->string('campaign_code', 50);

            $table->string('short_description', 500)
                ->nullable();

            $table->longText('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Fundraising Target
            |--------------------------------------------------------------------------
            */

            $table->decimal('target_amount', 18, 2);

            /*
            |--------------------------------------------------------------------------
            | Campaign Period
            |--------------------------------------------------------------------------
            */

            $table->date('start_date');

            $table->date('end_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Public Display
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_public')
                ->default(true);

            $table->boolean('is_featured')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('draft');

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Unique Constraints
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'project_id',
                'campaign_code'
            ]);

            $table->unique([
                'project_id',
                'slug'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'project_id',
                'status'
            ]);

            $table->index([
                'is_public',
                'is_featured'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};