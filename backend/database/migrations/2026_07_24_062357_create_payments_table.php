<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
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
            | Payment Reference
            |--------------------------------------------------------------------------
            */

            $table->string('payment_no', 60)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Donation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('donation_id')
                ->constrained('donations')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Payment Method
            |--------------------------------------------------------------------------
            */

            $table->string('payment_method', 50);

            /*
            |--------------------------------------------------------------------------
            | Gateway
            |--------------------------------------------------------------------------
            */

            $table->string('payment_gateway', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Transaction Information
            |--------------------------------------------------------------------------
            */

            $table->string('transaction_id', 200)
                ->nullable();

            $table->string('gateway_reference', 200)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Amount
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 18, 2);

            $table->char('currency', 3)
                ->default('BDT');

            /*
            |--------------------------------------------------------------------------
            | Payment Status
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('initiated');

            /*
            |--------------------------------------------------------------------------
            | Payment Metadata
            |--------------------------------------------------------------------------
            */

            $table->json('gateway_response')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Payment Dates
            |--------------------------------------------------------------------------
            */

            $table->timestamp('initiated_at')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamp('failed_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Manual Payment Information
            |--------------------------------------------------------------------------
            */

            $table->text('payer_note')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'donation_id',
                'status'
            ]);

            $table->index([
                'payment_method',
                'status'
            ]);

            $table->index('transaction_id');

            $table->index('paid_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};