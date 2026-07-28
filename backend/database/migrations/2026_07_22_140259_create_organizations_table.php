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
        Schema::create('organizations', function (Blueprint $table) {
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
            | Organization Information
            |--------------------------------------------------------------------------
            */
            $table->string('name', 200);

            $table->string('short_name', 100)
                ->nullable();

            $table->string('registration_no', 100)
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

            $table->string('website', 255)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Address
            |--------------------------------------------------------------------------
            */
            $table->text('address')
                ->nullable();

            $table->string('country', 100)
                ->nullable();

            $table->string('district', 100)
                ->nullable();

            $table->string('division', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Organization Branding
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
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index('name');
            $table->index('registration_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};