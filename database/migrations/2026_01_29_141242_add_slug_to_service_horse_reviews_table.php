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
        if (Schema::hasColumn('service_horse_reviews', 'slug')) {
            return;
        }

        Schema::table('service_horse_reviews', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('service_horse_reviews', 'slug')) {
            return;
        }

        Schema::table('service_horse_reviews', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }

};
