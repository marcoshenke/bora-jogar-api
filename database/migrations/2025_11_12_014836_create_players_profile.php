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
        Schema::create('player_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');

            $table->enum('dominant_foot', ['right', 'left', 'both'])->nullable();
            $table->enum('playing_style', ['fun', 'competitive', 'technical', 'social'])->nullable();
            $table->enum('skill_level', ['beginner', 'intermediate', 'regular', 'star'])->nullable();
            $table->enum('playing_frequency', ['weekly', 'occasionally', 'rarely'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_profiles');
    }
};
