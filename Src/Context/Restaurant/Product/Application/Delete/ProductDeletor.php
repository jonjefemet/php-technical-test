<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Application\Delete;

use App\Context\Restaurant\Product\Domain\ProductId;
use App\Context\Restaurant\Product\Domain\Repository\ProductRepository;

final class ProductDeletor
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    function delete(ProductId $id)
    {
        $this->productRepository->delete($id);
    }
}
