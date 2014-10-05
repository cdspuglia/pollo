<?php

namespace PolloTest\Domain\CommandHandler;

use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventStore\EventStoreInterface;
use Pollo\Domain\Command\Poll\CreateOption;
use Pollo\Domain\Command\Poll\CreatePoll;
use Pollo\Domain\Command\Poll\VoteOption;
use Pollo\Domain\CommandHandler\PollCommandHandler;
use Pollo\Domain\Model\Poll\Event\PollCreatedEvent;
use Pollo\Domain\Model\Poll\Event\OptionCreatedEvent;
use Pollo\Domain\Model\Poll\Event\OptionVotedEvent;
use Pollo\Domain\Model\Poll\PollId;
use Pollo\Domain\Repository\PollRepository;

class PollCommandHandlerTest extends CommandHandlerScenarioTestCase
{
    protected function createCommandHandler(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        $repository = new PollRepository($eventStore, $eventBus);

        return new PollCommandHandler($repository);
    }

    /** @test */
    public function new_poll_can_be_created()
    {
        $id =  new PollId();

        $this->scenario
            ->given(array())
            ->when(new CreatePoll($id, 'Poll title'))
            ->then(
                array(new PollCreatedEvent($id, 'Poll title'))
            );
    }

    /** @test */
    public function new_option_can_be_created()
    {
        $pollId =  new PollId();

        $this->scenario
            ->withAggregateId($pollId)
            ->given(
                array(new PollCreatedEvent($pollId, 'Poll title'))
            )
            ->when(new CreateOption($pollId, 'Option name'))
            ->then(
                array(new OptionCreatedEvent($pollId, 'Option name'))
            );
    }

    /** @test */
    public function option_with_invalid_name_throws_exception()
    {
        $this->setExpectedException(
            'Pollo\Domain\Model\Poll\Exception\InvalidOptionName',
            "Invalid option name ''"
        );

        $pollId =  new PollId();

        $this->scenario
            ->withAggregateId($pollId)
            ->given(
                array(new PollCreatedEvent($pollId, 'Poll title'))
            )
            ->when(new CreateOption($pollId, ''));
    }

    /** @test */
    public function existing_option_can_be_voted()
    {
        $pollId =  new PollId();

        $this->scenario
            ->withAggregateId($pollId)
            ->given(
                array(
                    new PollCreatedEvent($pollId, 'Poll title'),
                    new OptionCreatedEvent($pollId, 'Option name')
                )
            )
            ->when(new VoteOption($pollId, 0))
            ->then(
                array(new OptionVotedEvent($pollId, 0))
            );
    }

    /** @test */
    public function vote_non_existing_option_throws_exception()
    {
        $this->setExpectedException(
            'Pollo\Domain\Model\Poll\Exception\InvalidOptionNumber',
            "Invalid option number #1"
        );

        $pollId =  new PollId();

        $this->scenario
            ->withAggregateId($pollId)
            ->given(
                array(
                    new PollCreatedEvent($pollId, 'Poll title'),
                    new OptionCreatedEvent($pollId, 'Option name')
                )
            )
            ->when(new VoteOption($pollId, 1));
    }
}
