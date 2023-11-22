<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Application;

use App\Context\Restaurant\Product\Domain\Event\ProductStockReducedEvent;
use App\Context\Restaurant\Product\Domain\ProductId;
use App\Context\Restaurant\Product\Domain\Repository\ProductRepository;
use App\Context\Shared\Domain\Event\EventSubscriber;

class ReduceStockEventHandler implements EventSubscriber
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function subscribedTo(): array
    {
        return [
            ProductStockReducedEvent::class,
        ];
    }

    /**
     * @param ProductStockReducedEvent $event
     */
    public function handle($event): void
    {

        $product = $this->productRepository->search(new ProductId($event->productId));

        $product = $product->reduceStock($event->quantity);

        $this->productRepository->update($product);
    }
}
