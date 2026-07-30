<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {

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
            | Receipt Number
            |--------------------------------------------------------------------------
            */

            $table->string('receipt_no', 60)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Donation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('donation_id')
                ->unique()
                ->constrained('donations')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Payment
            |--------------------------------------------------------------------------
            */

            $table->foreignId('payment_id')
                ->unique()
                ->constrained('payments')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Receipt Information
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 18, 2);

            $table->char('currency', 3)
                ->default('BDT');

            $table->timestamp('issued_at');

            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            */

            $table->string('pdf_path', 500)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Email / SMS
            |--------------------------------------------------------------------------
            */

            $table->timestamp('email_sent_at')
                ->nullable();

            $table->timestamp('sms_sent_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_verified')
                ->default(true);

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

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('issued_at');

            $table->index('is_verified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};