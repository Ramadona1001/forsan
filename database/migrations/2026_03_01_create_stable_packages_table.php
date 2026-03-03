<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stable_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stable_id')->constrained('stables')->onDelete('cascade');
            $table->json('name')->comment('translatable');
            $table->json('description')->nullable()->comment('translatable');
            $table->decimal('price', 12, 2)->default(0);
            $table->json('features')->nullable()->comment('قائمة المزايا - مصفوفة نصوص');
            $table->boolean('is_recommended')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stable_packages');
    }
};
