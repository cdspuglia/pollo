<?php

namespace PolloTest\Core\Domain\CommandHandler;

use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventStore\EventStoreInterface;
use Pollo\Core\Domain\Command\Poll\CreateOption;
use Pollo\Core\Domain\Command\Poll\CreatePoll;
use Pollo\Core\Domain\Command\Poll\VoteOption;
use Pollo\Core\Domain\CommandHandler\PollCommandHandler;
use Pollo\Core\Domain\Model\Poll\Event\PollCreatedEvent;
use Pollo\Core\Domain\Model\Poll\Event\OptionCreatedEvent;
use Pollo\Core\Domain\Model\Poll\Event\OptionVotedEvent;
use Pollo\Core\Domain\Model\Poll\PollId;
use Pollo\Core\Domain\Repository\PollRepository;

class PollCommandHandlerTest extends CommandHandlerScenarioTestCase
{
    protected function createCommandHandler(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        $repository = new PollRepository($eventStore, $eventBus);

        return new PollCommandHandler($repository);
    }

    /**
     * @test
     * @group unit
     */
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

    /**
     * @test
     * @group unit
     */
    public function new_poll_with_empty_title_throws_exception()
    {
        $this->setExpectedException(
            'Pollo\Core\Domain\Model\Poll\Exception\InvalidPollTitle',
            "Invalid poll title ''"
        );

        $pollId =  new PollId();

        $this->scenario
            ->withAggregateId($pollId)
            ->when(new CreatePoll($pollId, ''));
    }

    /**
     * @test
     * @group unit
     */
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

    /**
     * @test
     * @group unit
     */
    public function option_with_invalid_name_throws_exception()
    {
        $this->setExpectedException(
            'Pollo\Core\Domain\Model\Poll\Exception\InvalidOptionName',
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

    /**
     * @test
     * @group unit
     */
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

    /**
     * @test
     * @group unit
     */
    public function vote_non_existing_option_throws_exception()
    {
        $this->setExpectedException(
            'Pollo\Core\Domain\Model\Poll\Exception\InvalidOptionNumber',
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
