<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('added_by')->nullable()->constrained('users')->onDelete('set null'); // enseignant
            $table->string('numero_inscription')->unique();
            $table->string('filiere')->nullable();
            $table->string('niveau')->nullable(); // L1, L2, L3, M1, M2
            $table->text('bio')->nullable();
            $table->string('cv')->nullable(); // path PDF
            $table->string('lettre_motivation')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->json('competences')->nullable(); // ["PHP", "Python", ...]
            $table->json('langues')->nullable();
            $table->json('experiences')->nullable();
            $table->json('formations')->nullable();
            $table->boolean('profile_completed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};