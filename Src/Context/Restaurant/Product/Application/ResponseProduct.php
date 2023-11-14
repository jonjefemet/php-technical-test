<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application;

use Src\Context\Restaurant\Product\Domain\Product;

final class ResponseProduct
{
    public readonly array $product;

    public function __construct(Product $product)
    {
        $this->product = $product->toPrimitives();
    }
}
