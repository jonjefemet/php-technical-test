<?php

declare(strict_types=1);

namespace App\Context\Restaurant\OrderItem\Domain\Repository;

use App\Context\Restaurant\Order\Domain\OrderId;
use App\Context\Restaurant\OrderItem\Domain\OrderItem;

interface OrderItemRepository
{
    /**
     * @param OrderItem[] $orderItems
     */
    function saveAll(array $orderItems): void;

    /**
     * @return OrderItem[]
     */
    function searchAllByOrderId(OrderId $orderId): array;
}
