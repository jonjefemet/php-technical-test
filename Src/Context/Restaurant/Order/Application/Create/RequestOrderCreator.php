<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Application\Create;

use App\Context\Restaurant\OrderItem\Domain\OrderItemQuantity;
use App\Context\Restaurant\Product\Domain\ProductId;

class RequestOrderCreator
{

    public readonly array $items;

    public function __construct(array $items)
    {
        $this->items = array_map(
            fn ($item) => array(
                'productId' => new ProductId($item['productId']),
                'quantity' => new OrderItemQuantity($item['quantity'])
            ),
            $items
        );
    }
}
