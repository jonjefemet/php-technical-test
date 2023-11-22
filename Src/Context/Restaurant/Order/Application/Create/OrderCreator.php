<?php

namespace App\Context\Restaurant\Order\Application\Create;

use App\Context\Restaurant\Order\Application\ResponseOrder;
use App\Context\Restaurant\Order\Domain\Order;
use App\Context\Restaurant\Order\Domain\Repository\OrderRepository;
use App\Context\Restaurant\OrderItem\Domain\Repository\OrderItemRepository;
use App\Context\Restaurant\Product\Domain\Repository\ProductRepository;
use App\Context\Shared\Infrastructure\EventBus;

class OrderCreator
{

    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly OrderItemRepository $orderItemRepository,
        private readonly ProductRepository $productRepository,
        private readonly EventBus $eventBus
    ) {
    }

    public function create(RequestOrderCreator $request)
    {

        $order = Order::create();

        $this->orderRepository->save($order);

        foreach ($request->items as $item) {
            $product = $this->productRepository->search($item['productId']);
            $newProduct = $product->reduceStock($item['quantity']->getValue());
            $order->addItem($newProduct, $item['quantity']);
            $this->eventBus->publish(...$product->pullDomainEvents());
        }

        $this->orderItemRepository->saveAll($order->getItems());

        return new ResponseOrder($order);
    }
}
