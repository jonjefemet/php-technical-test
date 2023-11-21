<?php

declare(strict_types=1);

namespace App\Context\Restaurant\OrderItem\Infrastructure\Collection;

use App\Context\Shared\Infrastructure\MongoDB\MongoCollectionWrapper;
use App\Context\Shared\Infrastructure\MongoDB\Restaurant\RestaurantMongoService;

class OrderItemMongoCollection extends MongoCollectionWrapper
{

    public function __construct()
    {
        parent::__construct(RestaurantMongoService::getInstance());
    }

    protected function collectionName(): string
    {
        return 'orderItems';
    }

    protected function databaseName(): string
    {
        return 'restaurant';
    }

    protected function getConfig(): array
    {
        return [
            'indexes' => [
                [
                    'keys' => ['orderId' => 1],
                    'options' => [],
                ],
            ],
        ];
    }
}
