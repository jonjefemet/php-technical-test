<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Application\Create;

use App\Context\Restaurant\Product\Domain\ProductName;
use App\Context\Restaurant\Product\Domain\ProductPrice;
use App\Context\Restaurant\Product\Domain\ProductStock;

final class RequestCreateProduct
{
    public readonly ProductName $name;
    public readonly ProductPrice $price;
    public readonly ProductStock $stock;

    public function __construct(
        string $name,
        float $price,
        int $stock
    ) {
        $this->name = new ProductName($name);
        $this->price = new ProductPrice($price);
        $this->stock = new ProductStock($stock);
    }
}
