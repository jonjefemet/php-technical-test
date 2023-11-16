<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Domain;

use App\Context\Shared\Domain\ValueObject\IntValueObject;

class ProductStock extends IntValueObject
{
    public function __construct(int $value)
    {
        parent::__construct($value);
        $this->ensureIsValidStock();
    }

    private function ensureIsValidStock(): void
    {
        if ($this->value < 0) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $this->value)
            );
        }
    }
}
