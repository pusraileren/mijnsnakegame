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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Sample data (zonder seeders/factories)
        $now = now();
        $teachersByName = DB::table('teachers')->pluck('id', 'name');

        DB::table('subjects')->insert([
            [
                'teacher_id' => $teachersByName['Mevrouw De Vries'] ?? null,
                'name' => 'Nederlands',
                'description' => 'Taalvaardigheid, spelling, spreken en schrijven.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Meneer Jansen'] ?? null,
                'name' => 'Rekenen',
                'description' => 'Basisvaardigheden rekenen, verhoudingen en percentages.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Meneer Van Dijk'] ?? null,
                'name' => 'Burgerschap',
                'description' => 'Samenleven, democratie, recht en plichten.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Mevrouw Bakker'] ?? null,
                'name' => 'Projectvaardigheden',
                'description' => 'Plannen, samenwerken en presenteren.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Mevrouw Smit'] ?? null,
                'name' => 'Loopbaan & Begeleiding (LOB)',
                'description' => 'Keuzes maken, reflecteren en ontwikkelen.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Mevrouw De Vries'] ?? null,
                'name' => 'Engels',
                'description' => 'Reading, listening, speaking en writing.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Meneer Jansen'] ?? null,
                'name' => 'Digitale Vaardigheden',
                'description' => 'Basis ICT, veilig online en Office-tools.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Mevrouw Bakker'] ?? null,
                'name' => 'Webdevelopment',
                'description' => 'HTML/CSS, PHP/Laravel en databases.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Meneer Van Dijk'] ?? null,
                'name' => 'Stagevoorbereiding',
                'description' => 'CV, sollicitatie, houding en afspraken.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'teacher_id' => $teachersByName['Mevrouw Smit'] ?? null,
                'name' => 'Keuzedeel',
                'description' => 'Verdieping binnen de opleiding, afhankelijk van keuze.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
