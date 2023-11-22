<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Application\Search;

use App\Context\Restaurant\Order\Application\ResponseOrders;
use App\Context\Restaurant\Order\Domain\Order;
use App\Context\Restaurant\Order\Domain\Repository\OrderRepository;
use App\Context\Restaurant\OrderItem\Domain\OrderItem;
use App\Context\Restaurant\OrderItem\Domain\Repository\OrderItemRepository;

final class OrdersFinder
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly OrderItemRepository $orderItemRepository
    ) {
    }

    function find()
    {
        $orders = $this->orderRepository->searchAll();

        $orders = array_map(function (Order $order) {
            $orderItems = $this->orderItemRepository->searchAllByOrderId($order->id);
            array_map(function (OrderItem $orderItem) use ($order) {
                $order->addOrderItem($orderItem);
            }, $orderItems);
            return $order;
        }, $orders);

        return new ResponseOrders($orders);
    }
}
