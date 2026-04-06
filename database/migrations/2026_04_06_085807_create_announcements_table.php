<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            // The SaaS Link:
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Links this announcement to a specific subject:
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->text('content');
            $table->date('due_date')->nullable(); // We'll use this for your "Days Left" math!
            $table->string('type')->default('General'); // e.g., Assignment, Project, Exam

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
