<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits')->nullable();
            $table->enum('type', ['full_time', 'part_time', 'freelance', 'internship', 'contract']);
            $table->enum('location_type', ['onsite', 'remote', 'hybrid']);
            $table->string('city')->nullable();
            $table->string('salary_min')->nullable();
            $table->string('salary_max')->nullable();
            $table->boolean('salary_visible')->default(true);
            $table->enum('experience', ['fresh_graduate', '1-2', '2-5', '5+']);
            $table->enum('status', ['active', 'closed', 'draft'])->default('active');
            $table->date('deadline')->nullable();
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
