<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('knights', function (Blueprint $table) {
            $table->id();
            $table->json('name')->comment('translatable');
            $table->json('description')->nullable()->comment('translatable');
            $table->string('slug')->unique()->nullable();
            $table->string('link')->nullable()->comment('رابط صفحة أو خارجي');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knights');
    }
};
