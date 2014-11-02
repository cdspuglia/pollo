<?php

namespace Pollo\Core\Domain\Command\Poll;

use Pollo\Adapter\Command\DomainCommandInterface;
use Pollo\Core\Domain\Command\Exception\CannotDeserializeCommand;
use Pollo\Core\Domain\Model\Poll\PollId;
use Pollo\Core\Validator\CommandSerializedData;

final class CreateOption implements DomainCommandInterface
{
    /** @var PollId */
    private $pollId;

    /** @var string */
    private $name;

    /**
     * Returns a new CreateOption command from serialized data
     *
     * @param array $data
     * @return self
     * @throws CannotDeserializeCommand
     */
    public static function deserialize(array $data)
    {
        $validator = new CommandSerializedData(array('pollId', 'name'));
        if (!$validator->isSatisfiedBy($data)) {
            throw new CannotDeserializeCommand($data, __CLASS__);
        }

        $id = new PollId($data['pollId']);

        return new self($id, $data['name']);
    }

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
