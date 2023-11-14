<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\ValueObject;

use App\Utilities\UuidGenerator;

abstract class UuidValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->ensureValueIsUuid();
    }

    private function ensureValueIsUuid(): void
    {
        if (!preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $this->value)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> Invalid UUID <%s>.', static::class, $this->value)
            );
        }
    }

    public static function random(): self
    {
        return new static(UuidGenerator::generate());
    }
}
