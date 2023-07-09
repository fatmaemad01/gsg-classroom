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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);  // VARCHAR NOT NULL
            $table->string('code', 10)->unique();
            $table->string('section')->nullable();
            $table->string('subject')->nullable();
            $table->string('room')->nullable();
            $table->string('cover_image_path')->nullable();
            $table->string('theme')->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();
            $table->enum('status', ['active', 'archived'])->default('active');

            // created at + updated at 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
