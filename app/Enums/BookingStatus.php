<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case NO_SHOW = 'no_show';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'قيد الانتظار',
            self::CONFIRMED => 'مؤكد',
            self::IN_PROGRESS => 'قيد التنفيذ',
            self::COMPLETED => 'مكتمل',
            self::CANCELLED => 'ملغي',
            self::NO_SHOW => 'لم يحضر',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::CONFIRMED => 'info',
            self::IN_PROGRESS => 'primary',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
            self::NO_SHOW => 'gray',
        };
    }
}
