<?php

namespace Pollo\Core\Domain\Command\Poll;

use Pollo\Adapter\Command\DomainCommandInterface;
use Pollo\Core\Domain\Command\Exception\CannotDeserializeCommand;
use Pollo\Core\Domain\Model\Poll\PollId;
use Pollo\Core\Validator\CommandSerializedData;

final class CreatePoll implements DomainCommandInterface
{
    /** @var PollId */
    private $pollId;

    /** @var string */
    private $title;

    /**
     * Returns a new CreatePoll command from serialized data
     *
     * @param array $data
     * @return self
     * @throws CannotDeserializeCommand
     */
    public static function deserialize(array $data)
    {
        $validator = new CommandSerializedData(array('pollId', 'title'));
        if (!$validator->isSatisfiedBy($data)) {
            throw new CannotDeserializeCommand($data, __CLASS__);
        }

        $id = new PollId($data['pollId']);

        return new self($id, $data['title']);
    }

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
