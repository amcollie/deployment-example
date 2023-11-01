<?php

declare(strict_types= 1);

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Enums\DimDivisor;
use App\Services\Shipping\PackageDimension;
use App\Services\Shipping\Weight;
use App\Services\Shipping\BillableWeightCalculatorService;

$package = [
    'weight' => 6,
    'dimensions' => [
        'width' => 9,
        'length' => 15,
        'height' => 7
    ],
];

$packageDimensions = new PackageDimension(
    $package['dimensions']['width'], 
    $package['dimensions']['height'], 
    $package['dimensions']['length'],
);

$weight = new Weight($package['weight']);


$billableWeight = (new BillableWeightCalculatorService())->calculate(
    $packageDimensions,
    $weight,
    DimDivisor::FEDEX
);

echo $billableWeight . ' lbs'. PHP_EOL;