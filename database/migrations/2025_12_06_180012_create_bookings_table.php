<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('horse_id')->nullable()->constrained('horses')->onDelete('set null');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->integer('duration')->nullable(); // in minutes
            $table->decimal('price', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->text('provider_notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
