<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Application\Update;

use App\Context\Restaurant\Product\Application\Update\RequestUpdateProduct;
use App\Context\Restaurant\Product\Application\ResponseProduct;
use App\Context\Restaurant\Product\Domain\Product;
use App\Context\Restaurant\Product\Domain\Repository\ProductRepository;

final class ProductUpdater
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    function update(RequestUpdateProduct $request)
    {
        $product = $this->productRepository->search($request->id);

        if ($product === null) throw new \RuntimeException("Product not found");

        $updatedProduct = new Product(
            $request->id,
            $request->name ?? $product->name,
            $request->price ?? $product->price,
            $request->stock ?? $product->stock,
        );

        return new ResponseProduct($updatedProduct);
    }
}
