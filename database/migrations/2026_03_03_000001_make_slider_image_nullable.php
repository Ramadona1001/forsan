<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Allow creating sliders without a value in the legacy `image` column.
        DB::statement('ALTER TABLE sliders MODIFY image VARCHAR(255) NULL');
    }

    public function down(): void
    {
        // Revert to requiring a non-null value in the `image` column.
        DB::statement('ALTER TABLE sliders MODIFY image VARCHAR(255) NOT NULL');
    }
};

