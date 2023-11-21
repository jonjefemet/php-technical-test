<?php

declare(strict_types=1);

namespace App\Context\Restaurant\OrderItem\Infrastructure\Repository;

use App\Context\Restaurant\Order\Domain\OrderId;
use App\Context\Restaurant\OrderItem\Domain\OrderItem;
use App\Context\Shared\Infrastructure\MongoDB\Collection;
use App\Context\Restaurant\OrderItem\Domain\Repository\OrderItemRepository;

class OrderItemMongoRepository implements OrderItemRepository
{
    private readonly Collection $orderItemMongoCollection;
    public function __construct(Collection $orderItemMongoCollection)
    {
        $this->orderItemMongoCollection = $orderItemMongoCollection;
    }

    function saveAll(array $orderItems): void
    {
        $this->orderItemMongoCollection->insertMany($orderItems);
    }

    function searchAllByOrderId(OrderId $orderId): array
    {
        $orderItems = $this->orderItemMongoCollection->find(['orderId' => $orderId->getValue()]);
        return array_map(
            fn (array $orderItem) => OrderItem::fromPrimitives(
                $orderItem['orderId'],
                $orderItem['productId'],
                $orderItem['quantity'],
                $orderItem['price']
            ),
            $orderItems
        );
    }
}
