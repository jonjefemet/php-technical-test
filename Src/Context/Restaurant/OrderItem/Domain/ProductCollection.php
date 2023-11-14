<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\OrderItem\Domain;

use Src\Context\Shared\Domain\Collection;

class ProductCollection extends Collection
{
    protected function type(): string
    {
        return Product::class;
    }

    /**
     * @return Product[]
     */
    public function items(): array
    {
        return $this->items;
    }
}
