<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application\Delete;

use Src\Context\Restaurant\Product\Application\Create\RequestUpdateProduct;
use Src\Context\Restaurant\Product\Application\ResponseProduct;
use Src\Context\Restaurant\Product\Domain\Product;
use Src\Context\Restaurant\Product\Domain\Repository\ProductRepository;

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
            $request->name ?? $product->name->getValue(),
            $request->price ?? $product->price->getValue(),
            $request->stock ?? $product->stock->getValue(),
        );

        return new ResponseProduct($updatedProduct);
    }
}
