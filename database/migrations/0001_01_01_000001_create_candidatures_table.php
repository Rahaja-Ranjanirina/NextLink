<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->foreignId('etudiant_id')->constrained('users')->onDelete('cascade');
            $table->text('message')->nullable(); // texte facultatif
            $table->string('cv')->nullable(); // PDF
            $table->string('lettre_motivation')->nullable(); // PDF
            $table->enum('statut', ['en_attente', 'vue', 'acceptee', 'refusee'])->default('en_attente');
            $table->boolean('is_read')->default(false); // lu par entreprise
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // destinataire
            $table->string('type'); // 'nouvelle_candidature', etc.
            $table->text('message');
            $table->morphs('notifiable'); // offre_id, etc.
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('candidatures');
    }
};