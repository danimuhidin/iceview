<?php

namespace App\Enums;

enum WarrantyItemPosition: string
{
    case Front = 'Kaca Depan';
    case DriverRight = 'Kanan Supir';
    case DriverLeft = 'Kiri Supir';
    case CenterRight = 'Tengah Kanan';
    case CenterLeft = 'Tengah Kiri';
    case Rear = 'Belakang';

    public static function values(): array
    {
        return array_map(static fn (self $position) => $position->value, self::cases());
    }
}