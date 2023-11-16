<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Infrastructure\Repository;

use App\Context\Restaurant\Product\Domain\Product;
use App\Context\Restaurant\Product\Domain\ProductId;
use App\Context\Restaurant\Product\Domain\Repository\ProductRepository;
use App\Context\Restaurant\Product\Infrastructure\Collection\ProductMongoCollection;
use App\Context\Shared\Infrastructure\MongoDB\Collection;

class ProductMongoRepository implements ProductRepository
{
    private readonly Collection $productCollection;

    public function __construct()
    {
        $this->productCollection =  new ProductMongoCollection();
    }

    public function save(Product $product): void
    {
        $this->productCollection->insertOne([
            '_id' => $product->id->getValue(),
            'name' => $product->name->getValue(),
            'price' => $product->price->getValue(),
            'stock' => $product->stock->getValue()
        ]);
    }

    public function search(ProductId $id): ?Product
    {
        $product = $this->productCollection->findOne(['_id' => $id->getValue()]);

        if (empty($product)) {
            return null;
        }

        return Product::fromPrimitives(
            $product['_id'],
            $product['name'],
            $product['price'],
            $product['stock']
        );
    }

    /**
     * @return Product[]
     */
    public function searchAll(): array
    {
        $products = $this->productCollection->find();
        return array_map(
            fn (array $product) => Product::fromPrimitives(
                $product['_id'],
                $product['name'],
                $product['price'],
                $product['stock']
            ),
            $products
        );
    }

    public function delete(ProductId $id): void
    {
        $this->productCollection->deleteOne(['_id' => $id->getValue()]);
    }

    public function update(Product $product): void
    {
        $this->productCollection->updateOne(
            ['_id' => $product->id->getValue()],
            [
                'name' => $product->name->getValue(),
                'price' => $product->price->getValue(),
                'stock' => $product->stock->getValue()
            ]
        );
    }
}
