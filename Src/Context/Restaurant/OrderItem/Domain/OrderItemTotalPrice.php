<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\OrderItem\Domain;

use App\Context\Shared\Domain\ValueObject\FloatValueObject;

class OrderItemTotalPrice extends FloatValueObject
{
    public function __construct(float $value)
    {
        parent::__construct($value);
        $this->ensureValidPrice();
    }

    private function ensureValidPrice(): void
    {
        if ($this->value < 0) {
            throw new \InvalidArgumentException("Order item price can't be negative");
        }
    }
}
