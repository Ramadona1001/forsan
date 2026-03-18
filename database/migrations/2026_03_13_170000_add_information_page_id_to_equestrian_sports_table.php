<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equestrian_sports', function (Blueprint $table) {
            $table->foreignId('information_page_id')->nullable()->after('id')->constrained('information_pages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('equestrian_sports', function (Blueprint $table) {
            $table->dropForeign(['information_page_id']);
        });
    }
};
