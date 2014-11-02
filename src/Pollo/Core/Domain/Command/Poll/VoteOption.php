<?php

namespace Pollo\Core\Domain\Command\Poll;

use Pollo\Adapter\Command\DomainCommandInterface;
use Pollo\Core\Domain\Command\Exception\CannotDeserializeCommand;
use Pollo\Core\Domain\Model\Poll\PollId;
use Pollo\Core\Validator\CommandSerializedData;

final class VoteOption implements DomainCommandInterface
{
    /** @var PollId */
    private $pollId;

    /** @var int */
    private $optionNumber;

    /**
     * Returns a new VoteOption command from serialized data
     *
     * @param array $data
     * @return self
     * @throws CannotDeserializeCommand
     */
    public static function deserialize(array $data)
    {
        $validator = new CommandSerializedData(array('pollId', 'optionNumber'));
        if (!$validator->isSatisfiedBy($data)) {
            throw new CannotDeserializeCommand($data, __CLASS__);
        }

        $id = new PollId($data['pollId']);

        return new self($id, $data['optionNumber']);
    }

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
}
