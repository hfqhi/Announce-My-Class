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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            // The SaaS Link: Ties this subject to a specific admin
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name'); // e.g., "Web Development"
            $table->string('code')->nullable(); // e.g., "BSCS-3A"
            $table->string('schedule_time')->nullable(); // We'll use this for your Regex parser later!
            $table->string('schedule_days')->nullable(); // e.g., "MWF"

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
