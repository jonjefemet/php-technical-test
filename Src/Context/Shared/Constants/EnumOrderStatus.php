<?php

declare(strict_types=1);

namespace App\Context\Shared\Constants;

use ReflectionClass;

enum EnumOrderStatus: string
{
    case PENDING = 'pending';
    case ON_PROCCES = 'on_procces';
    case COMPLETED = 'completed';

    public static function isValidValue(EnumOrderStatus $value): bool
    {
        return in_array($value, self::getConstants());
    }

    private static function getConstants(): array
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public static function transforStringToEnum(string $value): EnumOrderStatus
    {
        return match ($value) {
            'pending' => EnumOrderStatus::PENDING,
            'on_procces' => EnumOrderStatus::ON_PROCCES,
            'completed' => EnumOrderStatus::COMPLETED,
            default => throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $value)
            )
        };
    }
}
