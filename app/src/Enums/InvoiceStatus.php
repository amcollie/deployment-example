<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: int
{
    case PENDING = 0;
    case PAID = 1;
    case VOID = 2;
    case FAILED = 3;

    public function toString(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::PAID => 'Paid',
            self::VOID => 'Void',
            self::FAILED => 'Failed',
            default => 'unknown'
        };
    }

    public function color(): Color
    {
        return match($this) {
            self::PENDING => Color::Orange,
            self::PAID => Color::Green,
            self::VOID => Color::Gray,
            self::FAILED => Color::Red,
            default => Color::Yellow
        };
    }

    public static function fromColor(Color $color)
    {
        return match($color) {
            Color::Orange => self::PENDING,
            Color::Green => self::PAID,
            Color::Gray => self::VOID,
            Color::Red => self::FAILED,
            default => self::PENDING
        };
    }
}