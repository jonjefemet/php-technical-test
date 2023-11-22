<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Domain\Event;

use App\Context\Shared\Domain\Event\DomainEvent;

class ProductStockReducedEvent extends DomainEvent
{
    public function __construct(
        public readonly string $productId,
        public readonly int $quantity,
    ) {
        parent::__construct();
    }
}
