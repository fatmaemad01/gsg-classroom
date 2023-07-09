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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('answer', ['short_answer', 'multiple_choice'])->default('short_answer');
            $table->float('points')->default(0);
            $table->dateTime('due_date')->nullable();
            $table->enum('ask', ['ask', 'schedule', 'draft'])->default('ask');
            $table->string('topic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
