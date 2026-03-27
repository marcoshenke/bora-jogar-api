<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('week_days', function (Blueprint $table) {
            $table->tinyInteger('id')->primary();
            $table->string('name', 20);
        });

        DB::table('week_days')->insert([
            ['id' => 1, 'name' => 'Monday'],
            ['id' => 2, 'name' => 'Tuesday'],
            ['id' => 3, 'name' => 'Wednesday'],
            ['id' => 4, 'name' => 'Thursday'],
            ['id' => 5, 'name' => 'Friday'],
            ['id' => 6, 'name' => 'Saturday'],
            ['id' => 7, 'name' => 'Sunday'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('week_days');
    }
};
