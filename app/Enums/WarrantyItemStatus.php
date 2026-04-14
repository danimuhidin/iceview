<?php

namespace App\Enums;

enum WarrantyItemStatus: string
{
    case Active = 'Active';
    case PendingClaim = 'Pending Claim';
    case Claimed = 'Claimed';

    public static function values(): array
    {
        return array_map(static fn (self $status) => $status->value, self::cases());
    }

    public static function label(string $status): string
    {
        return match ($status) {
            self::Active->value => 'Active',
            self::PendingClaim->value => 'Pending Claim',
            self::Claimed->value => 'Claimed / Void',
            default => $status,
        };
    }
}