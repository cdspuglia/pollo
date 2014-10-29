<?php

namespace PolloTest\Core\Domain\Repository;

use Broadway\EventHandling\SimpleEventBus;
use Pollo\Core\Domain\Model\Poll\Poll;
use Pollo\Core\Domain\Model\Poll\PollId;
use Pollo\Core\Domain\Repository\PollRepository;
use Pollo\Core\EventStore\EventStore;
use PolloTest\TestCase;

class PollRepositoryTest extends TestCase
{
    /** @var PollRepository */
    private $repository;

    public function setup()
    {
        $url = $_ENV['EVENTSTORE_URL'];
        $connection = new \EventStore\EventStore($url);
        $eventStore = new EventStore($connection);
        $eventBus = new SimpleEventBus();
        $this->repository = new PollRepository($eventStore, $eventBus);
    }

    /**
     * @test
     * @group integration
     */
    public function new_poll_is_saved_and_loaded_through_eventstore()
    {
        $id = new PollId();
        $poll = Poll::create($id, 'Poll title');

        $this->repository->add($poll);
        $loadedPoll = $this->repository->load($id);

        $this->assertEquals($id, $loadedPoll->getAggregateRootId());
    }
}
