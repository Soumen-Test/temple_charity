<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_contents', function (Blueprint $table) {

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
            | Organization / Temple Scope
            |--------------------------------------------------------------------------
            |
            | Organization = NULL / Temple = NULL
            | can be used for global/system content.
            |
            */

            $table->foreignId('organization_id')
                ->nullable()
                ->constrained('organizations')
                ->nullOnDelete();

            $table->foreignId('temple_id')
                ->nullable()
                ->constrained('temples')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Content Identification
            |--------------------------------------------------------------------------
            |
            | Example:
            | homepage.hero_title
            | homepage.hero_description
            | about.title
            | about.description
            | contact.phone
            |
            */

            $table->string('content_key', 150);

            /*
            |--------------------------------------------------------------------------
            | Content Type
            |--------------------------------------------------------------------------
            |
            | text
            | textarea
            | html
            | url
            | number
            | json
            |
            */

            $table->string('content_type', 30)
                ->default('text');

            /*
            |--------------------------------------------------------------------------
            | Content Value
            |--------------------------------------------------------------------------
            */

            $table->longText('content_value')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Display Information
            |--------------------------------------------------------------------------
            */

            $table->string('title', 200)
                ->nullable();

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Public Visibility
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_public')
                ->default(true);

            $table->boolean('is_active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Sorting
            |--------------------------------------------------------------------------
            */

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
                'organization_id',
                'temple_id',
            ]);

            $table->index([
                'content_key',
                'is_active',
            ]);

            $table->index([
                'is_public',
                'is_active',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Unique Content Key
            |--------------------------------------------------------------------------
            |
            | Same key cannot be duplicated for the same
            | organization + temple scope.
            |
            */

            $table->unique([
                'organization_id',
                'temple_id',
                'content_key',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_contents');
    }
};