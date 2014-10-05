<?php

namespace Pollo\Domain\CommandHandler;

use Pollo\Domain\Command\Poll\CreateOption;
use Pollo\Domain\Command\Poll\CreatePoll;
use Pollo\Domain\Command\Poll\VoteOption;
use Pollo\Domain\Model\Poll\Poll;
use Pollo\Domain\Repository\PollRepository;

/**
 * Class PollCommandHandler
 *
 * @package Pollo\Domain\CommandHandler
 */
class PollCommandHandler extends CommandHandler
{
    /** @var PollRepository */
    private $repository;

    public function __construct(PollRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreatePoll $command
     */
    public function handleCreatePoll(CreatePoll $command)
    {
        $id = $command->getPollId();
        $name = $command->getTitle();
        $poll = Poll::create($id, $name);

        $this->repository->add($poll);
    }

    /**
     * @param CreateOption $command
     */
    public function handleCreateOption(CreateOption $command)
    {
        $pollId = $command->getPollId();
        $optionName = $command->getName();

        /** @var Poll $poll */
        $poll = $this->repository->load($pollId);
        $poll->createOption($optionName);

        $this->repository->add($poll);
    }

    /**
     * @param VoteOption $command
     */
    public function handleVoteOption(VoteOption $command)
    {
        $pollId = $command->getPollId();
        $optionNumber = $command->getOptionNumber();

        /** @var Poll $poll */
        $poll = $this->repository->load($pollId);
        $poll->vote($optionNumber);

        $this->repository->add($poll);
    }
}
