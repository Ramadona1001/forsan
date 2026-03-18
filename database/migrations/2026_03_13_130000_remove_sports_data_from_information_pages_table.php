<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('information_pages', function (Blueprint $table) {
            $table->dropColumn('sports_data');
        });
    }

    public function down(): void
    {
        Schema::table('information_pages', function (Blueprint $table) {
            $table->json('sports_data')->nullable()->after('table_data');
        });
    }
};
