<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_forum_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('body');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('student_forum_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('student_forum_topics')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_forum_messages');
        Schema::dropIfExists('student_forum_topics');
    }
};
