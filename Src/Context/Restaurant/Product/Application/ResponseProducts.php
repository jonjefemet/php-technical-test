<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application;

use Src\Context\Restaurant\Product\Domain\Product;

final class ResponseProducts
{
    public readonly array $products;

    /**
     * @param Product[] $product
     */
    public function __construct(array $product)
    {
        $this->products = array_map(fn (Product $product) => $product->toPrimitives(), $product);
    }
}
