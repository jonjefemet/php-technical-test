<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Infrastructure\Repository;

use App\Context\Restaurant\Order\Domain\Order;
use App\Context\Restaurant\Order\Domain\OrderId;
use App\Context\Restaurant\Order\Domain\Repository\OrderRepository;
use App\Context\Shared\Infrastructure\MongoDB\Collection;

class OrderMongoRepository implements OrderRepository
{
    private readonly Collection $orderItemMongoCollection;
    public function __construct(Collection $orderItemMongoCollection)
    {
        $this->orderItemMongoCollection = $orderItemMongoCollection;
    }

    function save(Order $order): void
    {
        $this->orderItemMongoCollection->insertOne([
            '_id' => $order->id->getValue(),
            'status' => $order->status->getValue()
        ]);
    }

    /**
     * @return Order[]
     */
    function searchAll(): array
    {
        $orders = $this->orderItemMongoCollection->find();
        return array_map(
            fn (array $order) => Order::fromPrimitives(
                $order['_id'],
                $order['status'],
            ),
            $orders
        );
    }

    function searchById(OrderId $id): ?Order
    {
        $order = $this->orderItemMongoCollection->findOne(['_id' => $id->getValue()]);
        if ($order === null) {
            return null;
        }
        return Order::fromPrimitives(
            $order['_id'],
            $order['status'],
        );
    }
}
