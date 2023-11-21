<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Domain;

use App\Context\Shared\Domain\Aggregate\AggregateRoot;

class Order extends AggregateRoot
{
    public readonly OrderId $id;

    public readonly OrderStatus $status;

    public function __construct(OrderId $id, OrderStatus $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id->getValue(),
            'status' => $this->status->getValue(),
        ];
    }

    static function fromPrimitives(string $id, string $status): Order
    {
        return new self(
            new OrderId($id),
            new OrderStatus($status)
        );
    }
}
