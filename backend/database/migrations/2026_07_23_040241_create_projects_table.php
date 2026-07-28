<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
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
            | Organization
            |--------------------------------------------------------------------------
            */

            $table->foreignId('organization_id')
                ->constrained('organizations')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Temple
            |--------------------------------------------------------------------------
            */

            $table->foreignId('temple_id')
                ->nullable()
                ->constrained('temples')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Project Information
            |--------------------------------------------------------------------------
            */

            $table->string('name', 200);

            $table->string('slug', 255);

            $table->string('project_code', 50);

            $table->string('project_type', 100)
                ->nullable();

            $table->text('short_description')
                ->nullable();

            $table->longText('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Target Information
            |--------------------------------------------------------------------------
            */

            $table->decimal('target_amount', 18, 2)
                ->nullable();

            $table->unsignedInteger('target_beneficiaries')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Project Schedule
            |--------------------------------------------------------------------------
            */

            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Public Visibility
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
            | Constraints
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'organization_id',
                'project_code'
            ]);

            $table->unique([
                'organization_id',
                'slug'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'organization_id',
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
        Schema::dropIfExists('projects');
    }
};