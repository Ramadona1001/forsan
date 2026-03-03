<?php

namespace App\Enums;

enum HorseStatus: string
{
    case AVAILABLE = 'available';
    case SOLD = 'sold';
    case RESERVED = 'reserved';
    case FOR_RENT = 'for_rent';
    case RENTED = 'rented';
    case NOT_FOR_SALE = 'not_for_sale';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'متاح للبيع',
            self::SOLD => 'مباع',
            self::RESERVED => 'محجوز',
            self::FOR_RENT => 'للإيجار',
            self::RENTED => 'مؤجر',
            self::NOT_FOR_SALE => 'غير معروض',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::AVAILABLE => 'success',
            self::SOLD => 'gray',
            self::RESERVED => 'warning',
            self::FOR_RENT => 'info',
            self::RENTED => 'primary',
            self::NOT_FOR_SALE => 'gray',
        };
    }
}
