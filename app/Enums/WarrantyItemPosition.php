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
    case Skkb = 'SKKB';
    case Skk = 'SKK';
    case Sunroof = 'SUNROOF';
    case Panoramic = 'PANORAMIC';

    public static function values(): array
    {
        return array_map(static fn (self $position) => $position->value, self::cases());
    }
}