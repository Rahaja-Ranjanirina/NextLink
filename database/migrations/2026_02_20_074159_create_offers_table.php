<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // entreprise ou enseignant
            $table->string('publisher_type'); // 'entreprise' | 'enseignant'
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('lien_externe')->nullable();
            $table->enum('type_offre', ['stage', 'emploi', 'alternance', 'these'])->default('stage');
            $table->string('localisation')->nullable();
            $table->date('date_limite')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('offre_medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->enum('type', ['image', 'video']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offre_medias');
        Schema::dropIfExists('offres');
    }
};