<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\OrderItem\Domain;

use Src\Context\Restaurant\Product\Domain\Product;
use Src\Context\Shared\Domain\Aggregate\AggregateRoot;

class OrderItem extends AggregateRoot
{

    public readonly OrderItemQuantity $quantity;

    public readonly OrderItemTotalPrice $totalPrice;

    public readonly ProductCollection $products;

    public function __construct(
        OrderItemQuantity $quantity,
        OrderItemTotalPrice $totalPrice,
        ProductCollection $products
    ) {
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
        $this->products = $products;
    }

    static function fromPrimitives(int $quantity, float $totalPrice, array $products): OrderItem
    {
        return new self(
            new OrderItemQuantity($quantity),
            new OrderItemTotalPrice($totalPrice),
            new ProductCollection(
                array_map(function (array $product) {
                    return Product::fromPrimitives(
                        $product['id'],
                        $product['name'],
                        $product['price'],
                        $product['stock']
                    );
                }, $products)
            )
        );
    }

    public function toPrimitives(): array
    {
        return [
            'quantity' => $this->quantity->getValue(),
            'totalPrice' => $this->totalPrice->getValue(),
            'products' => array_map(function (Product $product) {
                return $product->toPrimitives();
            }, $this->products->items())
        ];
    }
}
