<?php

namespace App\Enums;

enum UserType: string
{
    case CUSTOMER = 'customer';
    case HORSE_OWNER = 'horse_owner';
    case STABLE_OWNER = 'stable_owner';
    case STORE_OWNER = 'store_owner';
    case TRAINER = 'trainer';
    case VETERINARIAN = 'veterinarian';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::CUSTOMER => 'عميل',
            self::HORSE_OWNER => 'مالك خيول',
            self::STABLE_OWNER => 'مالك إسطبل',
            self::STORE_OWNER => 'مالك متجر',
            self::TRAINER => 'مدرب',
            self::VETERINARIAN => 'طبيب بيطري',
            self::ADMIN => 'مسؤول',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
