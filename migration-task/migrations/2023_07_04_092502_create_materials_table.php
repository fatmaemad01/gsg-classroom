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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title', 255);
            $table->string('description')->nullable();
            $table->string('topic')->nullable();
            $table->string('attach')->nullable();
            $table->enum('post' , ['post' , 'draft' , 'schedule' , 'discard'])->default('post');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
