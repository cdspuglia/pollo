<?php

namespace Pollo\Domain\Model\Poll\Event;

use Pollo\Domain\Event;
use Pollo\Domain\Model\Poll\PollId;

final class OptionCreatedEvent extends Event
{
    /** @var PollId */
    private $pollId;

    /** @var string */
    private $name;

    /**
     * @param PollId $poll_id Poll id
     * @param string $name Option name
     */
    public function __construct(PollId $poll_id, $name)
    {
        $this->pollId = $poll_id;
        $this->name = (string) $name;
    }

    /**
     * Get poll id
     *
     * @return PollId
     */
    public function getPollId()
    {
        return $this->pollId;
    }

    /**
     * Get option name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
