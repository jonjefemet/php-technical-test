<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\MongoDB;

interface Collection
{
    public function insertOne(array $document);

    public function insertMany(array $documents);

    public function findOne(array $filter = [], array $options = []): array;

    public function find(array $filter = [], array $options = []): array;

    public function updateOne(array $filter, array $update, array $options = []): int;

    public function deleteOne(array $filter, array $options = []): int;
}
