<?php

namespace Pollo\Core\Domain\Model\Poll\Event;

use Pollo\Core\Domain\Event;
use Pollo\Core\Domain\Model\Poll\PollId;

final class OptionVotedEvent extends Event
{
    /** @var PollId */
    private $pollId;

    /** @var int */
    private $optionNumber;

    /**
     * @param PollId $poll_id Voted poll id
     * @param int $option_number Option number
     */
    public function __construct(PollId $poll_id, $option_number)
    {
        $this->pollId = $poll_id;
        $this->optionNumber = (int) $option_number;
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
     * Get voted option number
     *
     * @return int
     */
    public function getOptionNumber()
    {
        return $this->optionNumber;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function deserialize(array $data)
    {
        $pollId = new PollId($data['pollId']);
        $event = new self($pollId, $data['optionNumber']);

        return $event;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array(
            'pollId' => (string) $this->pollId,
            'optionNumber' => $this->optionNumber
        );
    }
}
