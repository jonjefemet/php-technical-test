<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Product\Infrastructure\Collection;

use App\Context\Shared\Infrastructure\MongoDB\MongoCollectionWrapper;
use App\Context\Shared\Infrastructure\MongoDB\Restaurant\RestaurantMongoService;

class ProductMongoCollection extends MongoCollectionWrapper
{

    public function __construct()
    {
        parent::__construct(RestaurantMongoService::getInstance());
    }

    protected function collectionName(): string
    {
        return 'products';
    }

    protected function databaseName(): string
    {
        return 'restaurant';
    }
}
