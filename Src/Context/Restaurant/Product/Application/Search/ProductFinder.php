<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application\Delete;

use Src\Context\Restaurant\Product\Application\ResponseProduct;
use Src\Context\Restaurant\Product\Domain\ProductId;
use Src\Context\Restaurant\Product\Domain\Repository\ProductRepository;

final class ProductFinder
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    function find(ProductId $id)
    {
        $product = $this->productRepository->search($id);

        if ($product === null) throw new \RuntimeException("Product not found");

        return new ResponseProduct($product);
    }
}
