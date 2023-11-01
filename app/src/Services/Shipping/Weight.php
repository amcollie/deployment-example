<?php

declare(strict_types=1);

namespace App\Services\Shipping;
use InvalidArgumentException;

class Weight
{
    public function __construct(public readonly int $value)
    {
        match(true) {
            $this->value <= 0 || $this->value > 150 => throw new InvalidArgumentException('Invalid package weight.'),
            default => true
        };
    }

    public function equalTo(Weight $other): bool
    {
        return $this->value === $other->value;
    }
}