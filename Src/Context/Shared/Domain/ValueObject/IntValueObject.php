<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

class IntValueObject extends ValueObject
{
    public function __construct(int $value)
    {
        parent::__construct($value);
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
