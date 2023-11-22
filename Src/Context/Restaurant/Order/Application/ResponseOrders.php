<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Application;

use App\Context\Restaurant\Order\Domain\Order;
use App\Context\Restaurant\OrderItem\Domain\OrderItem;

class ResponseOrders
{
    public readonly array $orders;


    /**
     * ResponseOrders constructor.
     * @param Order[] $orders
     */
    public function __construct(array $orders)
    {

        $orders = array_map(function (Order $order) {
            $orderPrimitive = $order->toPrimitives();
            $orderPrimitive['orderItems'] = array_map(function (OrderItem $orderItem) {
                return $orderItem->toPrimitives();
            }, $order->getItems());
            $orderPrimitive['totalPrice'] = $order->getTotal();
            return $orderPrimitive;
        }, $orders);

        $this->orders = $orders;
    }
}
