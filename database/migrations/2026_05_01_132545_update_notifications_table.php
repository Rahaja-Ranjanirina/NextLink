<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            // Vérifie et ajoute uniquement si ça n'existe pas
            if (!Schema::hasColumn('notifications', 'notifiable_type') &&
                !Schema::hasColumn('notifications', 'notifiable_id')) {

                $table->morphs('notifiable'); // ✔ Laravel standard
            }

            // optionnel mais recommandé si tu n'as pas read_at
            if (!Schema::hasColumn('notifications', 'read_at')) {
                $table->timestamp('read_at')->nullable();
            }

            // si tu utilises user_id (custom système)
            if (!Schema::hasColumn('notifications', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }

            // sécurité: type + data si absents
            if (!Schema::hasColumn('notifications', 'type')) {
                $table->string('type')->nullable();
            }

            if (!Schema::hasColumn('notifications', 'data')) {
                $table->text('data')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            if (Schema::hasColumn('notifications', 'notifiable_type') &&
                Schema::hasColumn('notifications', 'notifiable_id')) {

                $table->dropMorphs('notifiable');
            }

            if (Schema::hasColumn('notifications', 'read_at')) {
                $table->dropColumn('read_at');
            }

            if (Schema::hasColumn('notifications', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('notifications', 'type')) {
                $table->dropColumn('type');
            }

            if (Schema::hasColumn('notifications', 'data')) {
                $table->dropColumn('data');
            }
        });
    }
};