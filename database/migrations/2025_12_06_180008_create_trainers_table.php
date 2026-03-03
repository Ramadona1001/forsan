<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('stable_id')->nullable()->constrained('stables')->onDelete('set null');
            $table->json('bio')->nullable(); // translatable
            $table->json('specializations')->nullable(); // jumping, dressage, etc.
            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->integer('students_count')->default(0);
            $table->json('availability')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
