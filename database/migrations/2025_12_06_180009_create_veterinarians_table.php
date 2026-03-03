<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('veterinarians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('bio')->nullable(); // translatable
            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();
            $table->json('specializations')->nullable();
            $table->string('clinic_name')->nullable();
            $table->text('clinic_address')->nullable();
            $table->string('clinic_phone')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->json('availability')->nullable();
            $table->boolean('home_visits')->default(false);
            $table->boolean('emergency_available')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinarians');
    }
};
