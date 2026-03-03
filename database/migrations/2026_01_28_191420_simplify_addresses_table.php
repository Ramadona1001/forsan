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
        Schema::table('addresses', function (Blueprint $table) {
            // Drop unnecessary columns
            $table->dropColumn(['first_name', 'last_name', 'phone', 'address_line_2']);

            // Rename columns to match new design
            $table->renameColumn('address_line_1', 'street');
            $table->renameColumn('title', 'type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_line_2')->nullable();

            $table->renameColumn('street', 'address_line_1');
            $table->renameColumn('type', 'title');
        });
    }
};
