<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

use DateTime;

class DateValueObject extends ValueObject
{
    public function __construct(DateTime $value)
    {
        parent::__construct($value);
    }

    public function getValue(): DateTime
    {
        return $this->value;
    }
}
