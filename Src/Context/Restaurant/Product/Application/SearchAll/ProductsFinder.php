<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Application\SearchAll;

use App\Context\Restaurant\Product\Application\ResponseProducts;
use App\Context\Restaurant\Product\Domain\Repository\ProductRepository;

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
