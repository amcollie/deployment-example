<?php

declare(strict_types=1);

namespace App\Attributes;

use App\Enums\HttpMethod;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Patch extends Route
{
    public function __construct(public string $path)
    {
        parent::__construct($path, HttpMethod::PATCH);
    }
}