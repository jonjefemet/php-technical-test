<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application\Delete;

use Src\Context\Restaurant\Product\Application\ResponseProducts;
use Src\Context\Restaurant\Product\Domain\Repository\ProductRepository;

final class ProductsFinder
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    function find()
    {
        $products = $this->productRepository->searchAll();

        return new ResponseProducts($products);
    }
}
