<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temples', function (Blueprint $table) {
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
            | Organization Relationship
            |--------------------------------------------------------------------------
            */
            $table->foreignId('organization_id')
                ->constrained('organizations')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Temple Information
            |--------------------------------------------------------------------------
            */
            $table->string('name', 200);

            $table->string('code', 50);

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Priest Information
            |--------------------------------------------------------------------------
            */
            $table->string('priest_name', 150)
                ->nullable();

            $table->string('priest_mobile', 30)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */
            $table->string('email', 150)
                ->nullable();

            $table->string('phone', 30)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Address
            |--------------------------------------------------------------------------
            */
            $table->text('address')
                ->nullable();

            $table->string('country', 100)
                ->default('Bangladesh');

            $table->string('district', 100)
                ->nullable();

            $table->string('division', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Google Map
            |--------------------------------------------------------------------------
            */
            $table->decimal('latitude', 10, 8)
                ->nullable();

            $table->decimal('longitude', 11, 8)
                ->nullable();

            $table->string('google_map_url', 500)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Established Information
            |--------------------------------------------------------------------------
            */
            $table->date('established_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */
            $table->string('logo_path', 500)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_active')
                ->default(true)
                ->index();

            /*
            |--------------------------------------------------------------------------
            | Audit Information
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

            /*
            |--------------------------------------------------------------------------
            | Additional Information
            |--------------------------------------------------------------------------
            */
            $table->text('remarks')
                ->nullable();

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Constraints
            |--------------------------------------------------------------------------
            */
            $table->unique([
                'organization_id',
                'code'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index([
                'organization_id',
                'is_active'
            ]);

            $table->index('name');
            $table->index('district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temples');
    }
};