<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application\Delete;

use Src\Context\Restaurant\Product\Domain\ProductId;
use Src\Context\Restaurant\Product\Domain\Repository\ProductRepository;

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
