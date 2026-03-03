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
        Schema::create('photographies', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->nullable();
            $table->json('description')->nullable();
            $table->json('features')->nullable();
            $table->json('video_gallery')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photographies');
    }
};
