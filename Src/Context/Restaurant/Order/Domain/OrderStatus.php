<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Domain;

use App\Context\Shared\Domain\ValueObject\StringValueObject;

class OrderStatus extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->ensureIsValidStatus();
    }

    private function ensureIsValidStatus(): void
    {
        if (!EnumOrderStatus::isValidValue($this->value)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $this->value)
            );
        }
    }
}
