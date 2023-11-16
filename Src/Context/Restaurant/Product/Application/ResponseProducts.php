<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Application;

use App\Context\Restaurant\Product\Domain\Product;

final class ResponseProducts
{
    public readonly array $products;

    /**
     * @param Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = array_map(fn (Product $product) => $product->toPrimitives(), $products);
    }
}
