<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Domain\Repository;

use Src\Context\Restaurant\Product\Domain\Product;
use Src\Context\Restaurant\Product\Domain\ProductId;

interface ProductRepository
{
    public function save(Product $product): void;

    public function search(ProductId $id): ?Product;

    /**
     * @return Product[]
     */
    public function searchAll(): array;

    public function delete(ProductId $id): void;

    public function update(Product $product): void;
}
