<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\MongoDB;

use MongoDB\Collection as MongoCollection;

abstract class MongoCollectionWrapper implements Collection
{
    abstract protected function collectionName(): string;

    abstract protected function databaseName(): string;

    private MongoCollection $collection;

    public function __construct(private readonly MongoService $service)
    {
        $this->collection = $service->getClient()->selectCollection(
            $this->databaseName(),
            $this->collectionName()
        );

        $config = $this->getConfig();
        $this->setIndexes($config['indexes'] ?? []);
    }

    public function insertOne(array $document, array $options = [])
    {
        $this->collection->insertOne($document, $options);
    }

    public function findOne(array $filter = [], array $options = []): array
    {
        $result = $this->collection->findOne($filter, $options);
        return $result !== null ? (array) $result : [];
    }

    public function find(array $filter = [], array $options = []): array
    {
        $result = $this->collection->find($filter, $options);
        return array_map(fn ($item) => (array) $item, iterator_to_array($result) ?? []);
    }

    public function updateOne(array $filter, array $update, array $options = []): int
    {
        $result = $this->collection->updateOne($filter, ['$set' => $update], $options);
        return $result->getModifiedCount();
    }

    public function deleteOne(array $filter, array $options = []): int
    {
        $result = $this->collection->deleteOne($filter, $options);
        return $result->getDeletedCount();
    }

    public function insertMany(array $documents, array $options = [])
    {
        $this->collection->insertMany($documents, $options);
    }

    abstract protected function getConfig(): array;

    private function setIndexes(array $indexes): void
    {
        foreach ($indexes as $index) {
            $this->collection->createIndex($index['keys'], $index['options'] ?? []);
        }
    }

    private function getSession(): array
    {
        $options = [];
        if ($this->service->session) {
            $options['session'] = $this->service->session;
        }
        return $options;
    }
}
