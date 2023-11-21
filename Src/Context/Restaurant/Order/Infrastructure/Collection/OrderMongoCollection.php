<?php

declare(strict_types=1);

namespace App\Context\Restaurant\Order\Infrastructure\Collection;

use App\Context\Shared\Infrastructure\MongoDB\MongoCollectionWrapper;
use App\Context\Shared\Infrastructure\MongoDB\Restaurant\RestaurantMongoService;

class OrderMongoCollection extends MongoCollectionWrapper
{

    public function __construct()
    {
        parent::__construct(RestaurantMongoService::getInstance());
    }

    protected function collectionName(): string
    {
        return 'orders';
    }

    protected function databaseName(): string
    {
        return 'restaurant';
    }

    protected function getConfig(): array
    {
        return [];
    }
}
