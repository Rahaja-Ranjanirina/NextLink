<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_forum_topics', function (Blueprint $table) {
            $table->json('attachments')->nullable()->after('slug');
        });

        Schema::table('student_forum_messages', function (Blueprint $table) {
            $table->json('attachments')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('student_forum_topics', function (Blueprint $table) {
            $table->dropColumn('attachments');
        });

        Schema::table('student_forum_messages', function (Blueprint $table) {
            $table->dropColumn('attachments');
        });
    }
};
