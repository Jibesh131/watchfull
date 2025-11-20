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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['movie', 'video', 'music']);
            $table->string('title', 255);
            $table->string('thumbnail')->nullable();
            $table->string('content_file')->nullable();
            $table->text('description')->nullable();
            $table->string('age_rating', 50)->nullable();
            $table->json('stars')->nullable();
            $table->json('genres')->nullable();
            $table->json('directors')->nullable();
            $table->json('writers')->nullable();
            $table->string('producer', 100)->nullable();
            $table->string('composer', 100)->nullable();
            $table->string('editor', 100)->nullable();
            $table->string('pd', 100)->comment('Production Designer')->nullable();
            $table->enum('status', ['published', 'draft', 'schedule', 'hidden', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
