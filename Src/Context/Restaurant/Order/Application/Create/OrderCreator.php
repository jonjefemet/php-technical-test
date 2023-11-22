<?php

namespace App\Context\Restaurant\Order\Application\Create;

use App\Context\Restaurant\Order\Domain\Repository\OrderRepository;
use App\Context\Restaurant\OrderItem\Domain\Repository\OrderItemRepository;

class OrderCreator
{

    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly OrderItemRepository $orderItemRepository
    ) {
    }

    public function create()
    {
    }
}
