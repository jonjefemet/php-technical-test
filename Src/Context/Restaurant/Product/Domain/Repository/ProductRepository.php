<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Domain\Repository;

use App\Context\Restaurant\Product\Domain\Product;
use App\Context\Restaurant\Product\Domain\ProductId;

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
