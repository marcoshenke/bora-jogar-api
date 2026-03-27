<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('player_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->tinyInteger('week_day_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            $table->foreign('week_day_id')->references('id')->on('week_days');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_availability');
    }
};
