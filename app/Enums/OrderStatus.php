<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'قيد الانتظار',
            self::CONFIRMED => 'مؤكد',
            self::PROCESSING => 'قيد التجهيز',
            self::SHIPPED => 'تم الشحن',
            self::DELIVERED => 'تم التسليم',
            self::CANCELLED => 'ملغي',
            self::REFUNDED => 'مسترجع',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::CONFIRMED => 'info',
            self::PROCESSING => 'primary',
            self::SHIPPED => 'info',
            self::DELIVERED => 'success',
            self::CANCELLED => 'danger',
            self::REFUNDED => 'gray',
        };
    }
}
