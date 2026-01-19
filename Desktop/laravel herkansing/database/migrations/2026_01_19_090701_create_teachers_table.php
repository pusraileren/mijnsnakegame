<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hobbies')->nullable();
            $table->timestamps();
        });

        // Sample data (zonder seeders/factories)
        $now = now();
        DB::table('teachers')->insert([
            ['name' => 'Mevrouw De Vries', 'hobbies' => 'Lezen, wandelen', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Meneer Jansen', 'hobbies' => 'Voetbal, gamen', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mevrouw Bakker', 'hobbies' => 'Koken, fotografie', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Meneer Van Dijk', 'hobbies' => 'Muziek maken', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mevrouw Smit', 'hobbies' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
