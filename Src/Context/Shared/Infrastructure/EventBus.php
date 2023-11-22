<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Domain\Event\DomainEvent;
use App\Context\Shared\Domain\Event\EventSubscriber;

class EventBus
{

    /**
     * @var array<class-string<DomainEvent>, EventSubscriber[]>
     */
    private array $subscribers = [];

    function subscribe(EventSubscriber $subscriber): void
    {
        foreach ($subscriber->subscribedTo() as $suscribedEvent) {
            $this->subscribers[$suscribedEvent][] = $subscriber;
        }
    }


    function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $this->publishEvent($event);
        }
    }

    private function publishEvent(DomainEvent $event): void
    {
        $eventClass = get_class($event);

        if (!isset($this->subscribers[$eventClass])) {
            return;
        }

        foreach ($this->subscribers[$eventClass] as $subscriber) {
            $subscriber->handle($event);
        }
    }
}
