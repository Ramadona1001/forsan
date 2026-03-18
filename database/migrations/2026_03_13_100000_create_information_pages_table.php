<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('information_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title')->nullable();
            $table->json('content')->nullable();
            $table->json('extra_section_title')->nullable();
            $table->json('extra_section_content')->nullable();
            $table->json('table_data')->nullable(); // for digital-services template: [{type, date, time, place, details}, ...]
            $table->string('template')->default('default'); // default, with_table, with_products_slider, with_sports_slider
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('information_pages');
    }
};
