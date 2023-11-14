<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Order\Domain;

use ReflectionClass;

enum EnumOrderStatus: string
{
    case PENDING = 'pending';
    case ON_PROCCES = 'on_procces';
    case COMPLETED = 'completed';

    public static function isValidValue(string $value): bool
    {
        return in_array($value, self::getConstants());
    }

    private static function getConstants(): array
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
