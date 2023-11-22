<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\MongoDB;

use MongoDB\Client as MongoClient;

abstract class MongoService
{

    private $client;

    public $session = null;

    public function __construct()
    {
        $this->client = new MongoClient($this->getUri());
    }

    public function getClient(): MongoClient
    {
        return $this->client;
    }

    abstract protected function getUri(): string;

    abstract public function startTransaction(): void;

    abstract public function commitTransaction(): void;

    abstract public function abortTransaction(): void;
}
