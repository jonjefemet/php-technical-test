<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application\Create;

use Src\Context\Restaurant\Product\Application\ResponseProduct;
use Src\Context\Restaurant\Product\Domain\Product;
use Src\Context\Restaurant\Product\Domain\Repository\ProductRepository;

final class ProductCreator
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    function create(RequestCreateProduct $request)
    {

        $product = Product::create(
            $request->name,
            $request->price,
            $request->stock,
        );

        $this->productRepository->save($product);

        return new ResponseProduct($product);
    }
}
