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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title', 255);
            $table->string('instructions')->nullable();
            $table->float('points')->default(0);
            $table->dateTime('due_date')->nullable();
            $table->string('topic')->nullable();
            $table->string('attach')->nullable();
            $table->enum('assign' , ['assign' , 'draft' , 'schedule' , 'discard'])->default('assign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
