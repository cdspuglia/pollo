<?php

namespace Pollo\Domain\Repository;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;

final class PollRepository extends EventSourcingRepository
{
    public function __construct(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        parent::__construct($eventStore, $eventBus, 'Pollo\Domain\Model\Poll\Poll');
    }
}
