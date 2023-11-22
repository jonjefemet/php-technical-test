<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Domain;

use App\Context\Shared\Constants\EnumOrderStatus;
use App\Context\Shared\Domain\ValueObject\StringValueObject;

class OrderStatus extends StringValueObject
{
    public function __construct(EnumOrderStatus $orderStatus)
    {
        parent::__construct($orderStatus->value);
        $this->ensureIsValidStatus($orderStatus);
    }

    private function ensureIsValidStatus(EnumOrderStatus $orderStatus): void
    {
        if (!EnumOrderStatus::isValidValue($orderStatus)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $this->value)
            );
        }
    }
}
