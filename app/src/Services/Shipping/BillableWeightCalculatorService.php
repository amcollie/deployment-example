<?php

declare(strict_types= 1);

namespace App\Services\Shipping;
use App\Enums\DimDivisor;
use InvalidArgumentException;

class BillableWeightCalculatorService
{
    /**
     * Summary of calculate
     * @param \App\Services\Shipping\PackageDimension $packageDimension
     * @param \App\Services\Shipping\Weight $weight
     * @param \App\Enums\DimDivisor $dimDivisor
     * @throws \InvalidArgumentException
     * @return int
     */
    public function calculate (
        PackageDimension $packageDimension,
        Weight $weight,
        DimDivisor $dimDivisor
    ): int
    {
        $dimWeight = (int) round(
            $packageDimension->width * $packageDimension->height * $packageDimension->length / $dimDivisor->value
        );

        return max($weight->value, $dimWeight);
    }
}