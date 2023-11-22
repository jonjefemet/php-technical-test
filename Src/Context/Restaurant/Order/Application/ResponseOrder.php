<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Application;

use App\Context\Restaurant\Order\Domain\Order;
use App\Context\Restaurant\OrderItem\Domain\OrderItem;

class ResponseOrder
{
    public readonly array $order;

    public function __construct(Order $order)
    {
        $orderPrimitive = $order->toPrimitives();
        $orderPrimitive['orderItems'] = array_map(function (OrderItem $orderItem) {
            return $orderItem->toPrimitives();
        }, $order->getItems());
        $this->order = $orderPrimitive;
    }
}
