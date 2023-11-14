<?php

declare(strict_types=1);

namespace Src\Context\Shared\Domain\Event;

abstract class DomainEvent
{
    private readonly string $eventId;
    private readonly \DateTimeImmutable $occurredOn;

    public function __construct()
    {
        $this->eventId = uniqid();
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
