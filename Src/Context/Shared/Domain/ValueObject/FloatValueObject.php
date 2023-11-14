<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

class FloatValueObject extends ValueObject
{
    public function __construct(float $value)
    {
        parent::__construct($value);
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
