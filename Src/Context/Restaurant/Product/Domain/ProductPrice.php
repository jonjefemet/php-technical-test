<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Domain;

use App\Context\Shared\Domain\ValueObject\FloatValueObject;

class ProductPrice extends FloatValueObject
{

    public function __construct(float $value)
    {
        parent::__construct($value);
        $this->ensureValidPrice();
    }

    private function ensureValidPrice(): void
    {
        if ($this->value < 0) {
            throw new \InvalidArgumentException("Product price can't be negative");
        }
    }
}
