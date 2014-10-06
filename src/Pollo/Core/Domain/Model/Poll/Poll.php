<?php

namespace Pollo\Core\Domain\Model\Poll;

use Pollo\Core\Domain\AggregateRoot;
use Pollo\Core\Domain\Model\Poll\Event\OptionCreatedEvent;
use Pollo\Core\Domain\Model\Poll\Event\OptionVotedEvent;
use Pollo\Core\Domain\Model\Poll\Event\PollCreatedEvent;
use Pollo\Core\Domain\Model\Poll\Exception\InvalidOptionName;
use Pollo\Core\Domain\Model\Poll\Exception\InvalidOptionNumber;
use Pollo\Core\Domain\Model\Poll\Exception\InvalidPollTitle;
use Pollo\Core\Domain\Model\Poll\Validator\OptionNameValidator;
use Pollo\Core\Domain\Model\Poll\Validator\OptionNumberValidator;
use Pollo\Core\Domain\Model\Poll\Validator\PollTitleValidator;

final class Poll extends AggregateRoot
{
    /** @var PollId */
    private $id;

    /** @var string */
    private $title;

    /** @var array */
    private $options;

    /**
     * Creates a new poll
     *
     * @param PollId $id
     * @param string $poll_title
     * @return Poll
     * @throws InvalidPollTitle
     */
    public static function create(PollId $id, $poll_title)
    {
        $validator = new PollTitleValidator();

        if (!$validator->isSatisfiedBy($poll_title)) {
            throw new InvalidPollTitle($poll_title);
        }

        $poll = new self();

        $poll->apply(
            new PollCreatedEvent($id, $poll_title)
        );

        return $poll;
    }

    /**
     * Creates new option with given name
     *
     * @param string $option_name
     * @throws InvalidOptionName
     */
    public function createOption($option_name)
    {
        $validator = new OptionNameValidator();

        if (!$validator->isSatisfiedBy($option_name)) {
            throw new InvalidOptionName($option_name);
        }

        $this->apply(
            new OptionCreatedEvent($this->id, $option_name)
        );
    }

    /**
     * Adds a vote to the given numbered option
     *
     * @param $option_number
     * @throws InvalidOptionNumber
     */
    public function vote($option_number)
    {
        $option_number = (int) $option_number;

        $validator = new OptionNumberValidator($this->options);

        if (!$validator->isSatisfiedBy($option_number)) {
            throw new InvalidOptionNumber($option_number);
        }

        $this->apply(
            new OptionVotedEvent($this->id, $option_number)
        );
    }

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->id->__toString();
    }

    /**
     * @return array
     */
    protected function getChildEntities()
    {
        return $this->options;
    }

    /**
     * @param PollCreatedEvent $event
     */
    protected function applyPollCreatedEvent(PollCreatedEvent $event)
    {
        $id = $event->getPollId();
        $title = $event->getTitle();

        $this->id = $id;
        $this->title = $title;
        $this->options = array();
    }

    /**
     * @param OptionCreatedEvent $event
     */
    protected function applyOptionCreatedEvent(OptionCreatedEvent $event)
    {
        $number = count($this->options);
        $name = $event->getName();

        $this->options[] = new Option($number, $name);
    }
}
