<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Domain;

use App\Context\Shared\Domain\ValueObject\StringValueObject;

class ProductName extends StringValueObject
{

    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->ensureIsNotEmpty();
    }
}
