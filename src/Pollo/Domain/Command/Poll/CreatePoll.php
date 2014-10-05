<?php

namespace Pollo\Domain\Command\Poll;

use Pollo\Domain\Model\Poll\PollId;

final class CreatePoll
{
    /** @var PollId */
    private $pollId;

    /** @var string */
    private $title;

    /**
     * @param PollId $id Poll id
     * @param string $title Poll title
     */
    public function __construct(PollId $id, $title)
    {
        $this->pollId = $id;
        $this->title = (string) $title;
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
     * Get poll title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
