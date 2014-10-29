<?php

namespace Pollo\Core\Domain\Model\Poll\Event;

use Pollo\Core\Domain\Event;
use Pollo\Core\Domain\Model\Poll\PollId;

final class PollCreatedEvent extends Event
{
    /** @var PollId */
    private $pollId;

    /** @var string */
    private $title;

    /**
     * @param PollId $poll_id Poll id
     * @param string $title Poll title
     */
    public function __construct(PollId $poll_id, $title)
    {
        $this->pollId = $poll_id;
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

    /**
     * @param array $data
     * @return self
     */
    public static function deserialize(array $data)
    {
        $pollId = new PollId($data['pollId']);
        $event = new self($pollId, $data['title']);

        return $event;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array(
            'pollId' => (string) $this->pollId,
            'title' => $this->title
        );
    }
}
