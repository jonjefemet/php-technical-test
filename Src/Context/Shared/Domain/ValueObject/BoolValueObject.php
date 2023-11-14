<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

class BoolValueObject extends ValueObject
{
    public function __construct(bool $value)
    {
        parent::__construct($value);
    }

    public function getValue(): bool
    {
        return $this->value;
    }
}
