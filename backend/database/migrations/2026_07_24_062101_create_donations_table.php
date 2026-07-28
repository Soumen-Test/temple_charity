<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Donation ID
            |--------------------------------------------------------------------------
            */

            $table->string('donation_no', 50)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Donor
            |--------------------------------------------------------------------------
            */

            $table->foreignId('donor_id')
                ->nullable()
                ->constrained('donors')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Project / Campaign
            |--------------------------------------------------------------------------
            */

            $table->foreignId('project_id')
                ->constrained('projects')
                ->restrictOnDelete();

            $table->foreignId('campaign_id')
                ->nullable()
                ->constrained('campaigns')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Donation Amount
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 18, 2);

            $table->char('currency', 3)
                ->default('BDT');

            /*
            |--------------------------------------------------------------------------
            | Donation Type
            |--------------------------------------------------------------------------
            */

            $table->string('donation_type', 50)
                ->default('one_time');

            /*
            |--------------------------------------------------------------------------
            | Donor Display
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_anonymous')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Donation Status
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('pending');

            /*
            |--------------------------------------------------------------------------
            | Donation Date
            |--------------------------------------------------------------------------
            */

            $table->timestamp('donated_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Note
            |--------------------------------------------------------------------------
            */

            $table->text('donor_note')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by')
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
                'project_id',
                'status'
            ]);

            $table->index([
                'campaign_id',
                'status'
            ]);

            $table->index([
                'donor_id',
                'status'
            ]);

            $table->index('donated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};