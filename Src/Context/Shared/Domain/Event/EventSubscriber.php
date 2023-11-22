<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\Event;

interface EventSubscriber
{
    /**
     * @return array<class-string<DomainEvent>, callable>
     */
    public function subscribedTo(): array;

    public function handle(DomainEvent $event): void;
}
