<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opening_balances', function (Blueprint $table) {

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
            |
            | NULL = Organization-level opening balance
            | Value = Temple-level opening balance
            |
            */

            $table->foreignId('temple_id')
                ->nullable()
                ->constrained('temples')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Financial Year
            |--------------------------------------------------------------------------
            |
            | Example:
            | 2026-2027
            |
            */

            $table->string('financial_year', 9);

            /*
            |--------------------------------------------------------------------------
            | Opening Balance
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 18, 2);

            $table->char('currency', 3)
                ->default('BDT');

            /*
            |--------------------------------------------------------------------------
            | Opening Date
            |--------------------------------------------------------------------------
            */

            $table->date('opening_date');

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('active');

            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */

            $table->text('remarks')
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

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Soft Delete
            |--------------------------------------------------------------------------
            */

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index([
                'organization_id',
                'financial_year',
            ]);

            $table->index([
                'temple_id',
                'financial_year',
            ]);

            $table->index([
                'status',
                'financial_year',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Unique Scope
            |--------------------------------------------------------------------------
            |
            | One opening balance per organization + temple + financial year.
            |
            */

            $table->unique([
                'organization_id',
                'temple_id',
                'financial_year',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opening_balances');
    }
};