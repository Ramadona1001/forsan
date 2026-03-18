<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
                $table->decimal('price', 10, 2)->default(0);
                $table->foreignId('provider_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('status')->default('active');
                $table->string('image')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            Schema::table('services', function (Blueprint $table) {
                if (! Schema::hasColumn('services', 'title')) {
                    $table->string('title')->after('id');
                }
                if (! Schema::hasColumn('services', 'description')) {
                    $table->text('description')->nullable()->after('title');
                }
                if (! Schema::hasColumn('services', 'category_id')) {
                    $table->foreignId('category_id')->nullable()->after('description')->constrained('categories')->nullOnDelete();
                }
                if (! Schema::hasColumn('services', 'price')) {
                    $table->decimal('price', 10, 2)->default(0)->after('category_id');
                }
                if (! Schema::hasColumn('services', 'provider_id')) {
                    $table->foreignId('provider_id')->nullable()->after('price')->constrained('users')->nullOnDelete();
                }
                if (! Schema::hasColumn('services', 'status')) {
                    $table->string('status')->default('active')->after('provider_id');
                }
                if (! Schema::hasColumn('services', 'image')) {
                    $table->string('image')->nullable()->after('status');
                }
                if (! Schema::hasColumn('services', 'is_featured')) {
                    $table->boolean('is_featured')->default(false)->after('image');
                }
                if (! Schema::hasColumn('services', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('services')) {
            Schema::dropIfExists('services');
        }
    }
};

