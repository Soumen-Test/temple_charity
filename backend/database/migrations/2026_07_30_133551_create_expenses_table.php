<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {

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
            | Expense Number
            |--------------------------------------------------------------------------
            */

            $table->string('expense_no', 60)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Organization / Temple
            |--------------------------------------------------------------------------
            */

            $table->foreignId('organization_id')
                ->constrained('organizations')
                ->restrictOnDelete();

            $table->foreignId('temple_id')
                ->nullable()
                ->constrained('temples')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Project / Campaign
            |--------------------------------------------------------------------------
            */

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('campaign_id')
                ->nullable()
                ->constrained('campaigns')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Expense Information
            |--------------------------------------------------------------------------
            */

            $table->date('expense_date');

            $table->string('title', 200);

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Expense Category
            |--------------------------------------------------------------------------
            */

            $table->string('expense_category', 100);

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
            | Payment Information
            |--------------------------------------------------------------------------
            */

            $table->string('payment_method', 50)
                ->nullable();

            $table->string('reference_no', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('draft');

            $table->foreignId('submitted_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('submitted_at')
                ->nullable();

            $table->timestamp('approved_at')
                ->nullable();

            $table->text('approval_remarks')
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
                'expense_date'
            ]);

            $table->index([
                'temple_id',
                'expense_date'
            ]);

            $table->index([
                'project_id',
                'expense_date'
            ]);

            $table->index([
                'campaign_id',
                'expense_date'
            ]);

            $table->index([
                'status',
                'expense_date'
            ]);

            $table->index('expense_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};