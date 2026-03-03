<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_number',
        'user_id',
        'bookable_id',
        'bookable_type',
        'package_id',
        'package_type',
        // 'service_id',
        'horse_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'price',
        'status',
        'payment_status',
        'payment_method',
        'notes',
        'provider_notes',
        'confirmed_at',
        'completed_at',
        'cancelled_at',
        'cancellation_reason',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'price' => 'decimal:2',
            'status' => BookingStatus::class,
            'payment_status' => PaymentStatus::class,
            'confirmed_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->booking_number = 'BK-' . strtoupper(uniqid());
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }

    public function package(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', BookingStatus::PENDING);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', BookingStatus::CONFIRMED);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->toDateString());
    }

    /**
     * عرض اسم الخدمة/الباقة المرتبطة بالحجز (متوافق مع HorseReview, Photography, StablePackage).
     */
    public function getBookableDisplayNameAttribute(): ?string
    {
        $b = $this->bookable;
        if (! $b) {
            return null;
        }
        $locale = app()->getLocale();
        $translatable = $b->translatable ?? [];
        // استخدم title إن وُجد في translatable، وإلا name (مثل StablePackage)
        if (in_array('title', $translatable)) {
            return $b->getTranslation('title', $locale);
        }
        return $b->getTranslation('name', $locale);
    }

    // Helpers
    public function canBeCancelled(): bool
    {
        return in_array($this->status, [BookingStatus::PENDING, BookingStatus::CONFIRMED]);
    }

    public function confirm(): void
    {
        $this->update([
            'status' => BookingStatus::CONFIRMED,
            'confirmed_at' => now(),
        ]);
    }

    public function complete(): void
    {
        $this->update([
            'status' => BookingStatus::COMPLETED,
            'completed_at' => now(),
        ]);
    }

    public function cancel(?string $reason = null): void
    {
        $this->update([
            'status' => BookingStatus::CANCELLED,
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
        ]);
    }
}
