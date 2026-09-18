<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_sponsors', function (Blueprint $table) {

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
            | Campaign
            |--------------------------------------------------------------------------
            */

            $table->foreignId('campaign_id')
                ->constrained('campaigns')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Sponsor Information
            |--------------------------------------------------------------------------
            */

            $table->string('name', 200);

            $table->string('organization_name', 200)
                ->nullable();

            $table->string('mobile', 30)
                ->nullable();

            $table->string('email', 150)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Sponsor Type
            |--------------------------------------------------------------------------
            */

            $table->string('sponsor_type', 30)
                ->default('individual');

            /*
            |--------------------------------------------------------------------------
            | Display Information
            |--------------------------------------------------------------------------
            */

            $table->text('description')
                ->nullable();

            $table->boolean('is_public')
                ->default(true);

            $table->boolean('is_featured')
                ->default(false);

            $table->boolean('is_active')
                ->default(true);

            $table->unsignedInteger('sort_order')
                ->default(0);

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
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'campaign_id',
                'is_active',
            ]);

            $table->index([
                'campaign_id',
                'is_public',
            ]);

            $table->index([
                'is_featured',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_sponsors');
    }
};