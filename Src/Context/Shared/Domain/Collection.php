<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

use Countable;
use IteratorAggregate;
use Traversable;
use ArrayIterator;


abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @var AggregateRoot[]
     */
    protected array $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);
        $this->items = $items;
    }

    abstract protected function type(): string;

    final public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    final public function count(): int
    {
        return count($this->items);
    }

    abstract public function items(): array;
}
