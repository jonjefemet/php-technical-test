<?php

declare(strict_types=1);

namespace App\Context\Restaurant\OrderItem\Infrastructure\Repository;

use App\Context\Restaurant\Order\Domain\OrderId;
use App\Context\Restaurant\OrderItem\Domain\OrderItem;
use App\Context\Shared\Infrastructure\MongoDB\Collection;
use App\Context\Restaurant\OrderItem\Domain\Repository\OrderItemRepository;
use App\Context\Restaurant\OrderItem\Infrastructure\Collection\OrderItemMongoCollection;

class OrderItemMongoRepository implements OrderItemRepository
{
    private readonly Collection $orderItemMongoCollection;
    public function __construct()
    {
        $this->orderItemMongoCollection = new OrderItemMongoCollection();
    }

    /**
     * @param OrderItem[] $orderItems
     */
    function saveAll(array $orderItems): void
    {
        $orderItems = array_map(
            fn (OrderItem $orderItem) => [
                'orderId' => $orderItem->orderId->getValue(),
                'productId' => $orderItem->productId->getValue(),
                'quantity' => $orderItem->quantity->getValue(),
                'totalPrice' => $orderItem->totalPrice->getValue(),
            ],
            $orderItems
        );
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
                $orderItem['totalPrice']
            ),
            $orderItems
        );
    }
}
