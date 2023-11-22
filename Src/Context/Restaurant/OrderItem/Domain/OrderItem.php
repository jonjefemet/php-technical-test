<?php

declare(strict_types=1);

namespace App\Context\Restaurant\OrderItem\Domain;

use App\Context\Restaurant\Order\Domain\OrderId;
use App\Context\Restaurant\Product\Domain\ProductId;
use App\Context\Shared\Domain\Aggregate\AggregateRoot;

class OrderItem extends AggregateRoot
{

    public readonly OrderId $orderId;

    public readonly ProductId $productId;

    public readonly OrderItemQuantity $quantity;

    public readonly OrderItemTotalPrice $totalPrice;

    public function __construct(
        OrderId $orderId,
        ProductId $productId,
        OrderItemQuantity $quantity,
        OrderItemTotalPrice $totalPrice,
    ) {
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
    }

    static function fromPrimitives(string $orderId, string $productId, int $quantity, float $totalPrice): OrderItem
    {
        return new self(
            new OrderId($orderId),
            new ProductId($productId),
            new OrderItemQuantity($quantity),
            new OrderItemTotalPrice($totalPrice),
        );
    }

    static function create(OrderId $orderId, ProductId $productId, OrderItemQuantity $quantity, OrderItemTotalPrice $totalPrice): OrderItem
    {
        return new self(
            $orderId,
            $productId,
            $quantity,
            $totalPrice,
        );
    }

    public function toPrimitives(): array
    {
        return [
            'productId' => $this->productId->getValue(),
            'quantity' => $this->quantity->getValue(),
            'totalPrice' => $this->totalPrice->getValue(),
        ];
    }
}
