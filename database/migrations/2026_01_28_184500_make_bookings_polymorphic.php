<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign key first if it exists (using array syntax for safety)
            // But since I don't know the exact constraint name, I'll try dropping column directly or just making it nullable if I can't drop FK easily without name.
            // Better to add new columns first.

            $table->unsignedBigInteger('bookable_id')->nullable()->after('user_id');
            $table->string('bookable_type')->nullable()->after('bookable_id');
            $table->index(['bookable_id', 'bookable_type']);

            // Make service_id nullable or drop it.
            // Since we deleted the services table, the FK might already be broken or preventing actions if constraints exist.
            // If the services table was dropped, the FK on bookings.service_id should have been dropped too if cascade, or might be dangling.
            // I'll attempt to drop the column.
            if (Schema::hasColumn('bookings', 'service_id')) {
                // We might need to drop foreign key first.
                // $table->dropForeign(['service_id']); 
                // Simple drop column might fail if FK exists and wasn't dropped.
                // Given the previous steps, let's just make it nullable to be safe and ignore it.
                $table->unsignedBigInteger('service_id')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['bookable_id', 'bookable_type']);
        });
    }
};
