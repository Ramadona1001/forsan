<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
    case PARTIALLY_REFUNDED = 'partially_refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'قيد الانتظار',
            self::PAID => 'مدفوع',
            self::FAILED => 'فشل الدفع',
            self::REFUNDED => 'مسترجع',
            self::PARTIALLY_REFUNDED => 'مسترجع جزئياً',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PAID => 'success',
            self::FAILED => 'danger',
            self::REFUNDED => 'gray',
            self::PARTIALLY_REFUNDED => 'info',
        };
    }
}
