<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Domain\Repository;

use App\Context\Restaurant\Order\Domain\Order;
use App\Context\Restaurant\Order\Domain\OrderId;

interface OrderRepository
{
    function save(Order $order): void;

    /**
     * @return Order[]
     */
    function searchAll(): array;

    function searchById(OrderId $id): ?Order;
}
