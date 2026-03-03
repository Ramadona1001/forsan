<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_horse_reviews', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Translatable
            $table->json('description'); // Translatable
            $table->decimal('price', 10, 2);
            $table->json('trainer_info')->nullable(); // Translatable
            $table->json('video_gallery')->nullable(); // JSON Array for videos
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_horse_reviews');
    }
};
