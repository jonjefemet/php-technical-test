<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\MongoDB\Restaurant;

use App\Context\Shared\Infrastructure\MongoDB\MongoService;

class RestaurantMongoService extends MongoService
{
    private static ?RestaurantMongoService $instance = null;

    public static function getInstance(): RestaurantMongoService
    {
        if (self::$instance == null) {
            self::$instance = new RestaurantMongoService();
        }

        return self::$instance;
    }

    protected function getUri(): string
    {
        return 'mongodb://192.168.64.1:27017';
    }

    public function startTransaction(): void
    {
        $this->session = $this->getClient()->startSession();
        $this->session->startTransaction();
    }

    public function commitTransaction(): void
    {
        if ($this->session) {
            $this->session->commitTransaction();
            $this->session->endSession();
            $this->session = null;
        }
    }

    public function abortTransaction(): void
    {
        if ($this->session) {
            $this->session->abortTransaction();
            $this->session->endSession();
            $this->session = null;
        }
    }
}
