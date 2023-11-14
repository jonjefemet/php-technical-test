<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

class StringValueObject extends ValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    protected function ensureIsNotEmpty(): void
    {
        if (empty($this->value)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s can not be empty',
                    static::class
                )
            );
        }
    }
}
