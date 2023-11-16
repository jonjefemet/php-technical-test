<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Domain;

use App\Utilities\UuidGenerator;
use App\Context\Shared\Domain\Aggregate\AggregateRoot;

class Product extends AggregateRoot
{

    public readonly ProductId $id;

    public readonly ProductName $name;

    public readonly ProductPrice $price;

    public readonly ProductStock $stock;

    public function __construct(ProductId $id, ProductName $name, ProductPrice $price, ProductStock $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    static function fromPrimitives(string $id, string $name, float $price, int $stock): Product
    {
        return new self(
            new ProductId($id),
            new ProductName($name),
            new ProductPrice($price),
            new ProductStock($stock)
        );
    }

    static function create(ProductName $name, ProductPrice $price, ProductStock $stock): Product
    {
        return new self(
            new ProductId(UuidGenerator::generate()),
            $name,
            $price,
            $stock
        );
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id->getValue(),
            'name' => $this->name->getValue(),
            'price' => $this->price->getValue(),
            'stock' => $this->stock->getValue(),
        ];
    }
}
