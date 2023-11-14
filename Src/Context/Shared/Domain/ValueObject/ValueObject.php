<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

abstract class ValueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
        $this->ensureValueIsDefined();
    }

    abstract public function getValue();

    private function ensureValueIsDefined()
    {
        if (null === $this->value) {
            throw new \InvalidArgumentException(
                sprintf(
                    '<%s> does not allow the value <%s>.',
                    static::class,
                    $this->value
                )
            );
        }
    }
}
