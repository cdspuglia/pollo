<?php

namespace Pollo\Core\Domain\Command\Poll;

use Pollo\Core\Domain\Model\Poll\PollId;

final class CreateOption
{
    /** @var PollId */
    private $pollId;

    /** @var string */
    private $name;

    /**
     * @param PollId $poll_id Voted poll id
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
