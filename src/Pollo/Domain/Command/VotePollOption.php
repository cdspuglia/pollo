<?php

namespace Pollo\Domain\Command;

use Pollo\Domain\Model\Poll\PollOptionId;

final class VotePollOption
{
    /** @var PollOptionId */
    private $pollOptionId;

    /**
     * @param PollOptionId $poll_option_id Voted poll option id
     */
    public function __construct(PollOptionId $poll_option_id)
    {
        $this->pollOptionId = $poll_option_id;
    }

    /**
     * Get voted poll option
     *
     * @return PollOptionId
     */
    public function getPollOptionId()
    {
        return $this->pollOptionId;
    }
}