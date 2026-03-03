<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->json('name'); // translatable
            $table->json('description')->nullable(); // translatable
            $table->string('sku')->nullable()->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('low_stock_threshold')->default(5);
            $table->string('weight')->nullable();
            $table->json('dimensions')->nullable();
            $table->json('attributes')->nullable(); // color, size, etc.
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('track_inventory')->default(true);
            $table->integer('views_count')->default(0);
            $table->integer('sales_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
