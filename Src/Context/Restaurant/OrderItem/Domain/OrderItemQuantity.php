<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\OrderItem\Domain;

use App\Context\Shared\Domain\ValueObject\IntValueObject;

class OrderItemQuantity extends IntValueObject
{
    public function __construct(int $value)
    {
        parent::__construct($value);
        $this->ensureIsValidQuantity();
    }

    private function ensureIsValidQuantity(): void
    {
        if ($this->value < 0) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $this->value)
            );
        }
    }
}
