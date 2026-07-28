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
        Schema::create('files', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | File Owner / Polymorphic Relationship
            |--------------------------------------------------------------------------
            */
            $table->nullableMorphs('fileable');

            /*
            |--------------------------------------------------------------------------
            | File Information
            |--------------------------------------------------------------------------
            */
            $table->string('original_name', 255);

            $table->string('file_name', 255);

            $table->string('disk', 50)
                ->default('public');

            $table->string('path', 500);

            /*
            |--------------------------------------------------------------------------
            | File Type
            |--------------------------------------------------------------------------
            */
            $table->string('mime_type', 100)
                ->nullable();

            $table->string('extension', 20)
                ->nullable();

            $table->unsignedBigInteger('size')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Optional Image Information
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('width')
                ->nullable();

            $table->unsignedInteger('height')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | File Category
            |--------------------------------------------------------------------------
            */
            $table->string('collection', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Visibility
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_public')
                ->default(false)
                ->index();

            /*
            |--------------------------------------------------------------------------
            | Uploaded By
            |--------------------------------------------------------------------------
            */
            $table->foreignId('uploaded_by')
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
            $table->index([
                'collection',
                'is_public'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};