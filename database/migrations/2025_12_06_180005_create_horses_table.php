<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('stable_id')->nullable()->constrained('stables')->onDelete('set null');
            $table->json('name'); // translatable
            $table->json('description')->nullable(); // translatable
            $table->string('breed')->nullable();
            $table->string('color')->nullable();
            $table->string('gender')->nullable(); // male, female
            $table->date('birth_date')->nullable();
            $table->integer('age')->nullable();
            $table->decimal('height', 5, 2)->nullable(); // in cm
            $table->decimal('weight', 6, 2)->nullable(); // in kg
            $table->string('registration_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('microchip_number')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('rent_price_per_day', 10, 2)->nullable();
            $table->string('status')->default('available');
            $table->json('disciplines')->nullable(); // jumping, dressage, etc.
            $table->json('health_records')->nullable();
            $table->json('achievements')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('pedigree')->nullable();
            $table->boolean('is_for_sale')->default(false);
            $table->boolean('is_for_rent')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horses');
    }
};
