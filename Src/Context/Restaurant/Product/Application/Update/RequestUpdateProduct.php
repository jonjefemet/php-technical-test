<?php

declare(strict_types=1);

namespace Src\Context\Restaurant\Product\Application\Create;

use Src\Context\Restaurant\Product\Domain\ProductId;
use Src\Context\Restaurant\Product\Domain\ProductName;
use Src\Context\Restaurant\Product\Domain\ProductPrice;
use Src\Context\Restaurant\Product\Domain\ProductStock;

final class RequestUpdateProduct
{
    public readonly ProductId $id;
    public readonly ?ProductName $name;
    public readonly ?ProductPrice $price;
    public readonly ?ProductStock $stock;

    public function __construct(
        string $id,
        array $partialProduct,
    ) {
        $this->id = new ProductId($id);
        $this->name = isset($partialProduct['name']) ? new ProductName($partialProduct['name']) : null;
        $this->price = isset($partialProduct['price']) ? new ProductPrice($partialProduct['price']) : null;
        $this->stock = isset($partialProduct['stock']) ? new ProductStock($partialProduct['stock']) : null;
    }
}
