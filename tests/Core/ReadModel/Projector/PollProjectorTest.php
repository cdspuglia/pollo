<?php

namespace PolloTest\Core\ReadModel\Projector;

use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Testing\ProjectorScenarioTestCase;
use Pollo\Core\Domain\Model\Poll\Event\PollCreatedEvent;
use Pollo\Core\Domain\Model\Poll\PollId;
use Pollo\Core\ReadModel\Model\Poll;
use Pollo\Core\ReadModel\Projector\PollProjector;

class PollProjectorTest extends ProjectorScenarioTestCase
{
    public function createProjector(InMemoryRepository $repository)
    {
        return new PollProjector($repository);
    }

    /**
     * @test
     * @group unit
     */
    public function poll_created_inserts_a_new_entry()
    {
        $id = new PollId();
        $title = 'Poll title';

        $poll = new Poll($id->__toString(), $title);

        $this->scenario
            ->given()
            ->when(new PollCreatedEvent($id, $title))
            ->then(array($poll));
    }
}
