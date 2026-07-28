<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Donor Information
            |--------------------------------------------------------------------------
            */

            $table->string('name', 150);

            $table->string('mobile', 30);

            $table->string('email', 150)
                ->nullable();

            $table->text('address')
                ->nullable();

            $table->string('district', 100)
                ->nullable();

            $table->string('country', 100)
                ->default('Bangladesh');

            /*
            |--------------------------------------------------------------------------
            | Privacy
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_anonymous')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Account
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('mobile');

            $table->index('email');

            $table->index('is_anonymous');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};