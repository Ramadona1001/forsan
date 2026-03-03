<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stables', function (Blueprint $table) {
            $table->string('stable_type')->nullable()->after('country')->comment('نوع الإسطبل مثل: قفز، ركوب، إلخ');
        });
    }

    public function down(): void
    {
        Schema::table('stables', function (Blueprint $table) {
            $table->dropColumn('stable_type');
        });
    }
};
