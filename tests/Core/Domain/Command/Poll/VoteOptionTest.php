<?php

namespace PolloTest\Core\Domain\Command;

use Pollo\Core\Domain\Command\Poll\VoteOption;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class VoteOptionTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function poll_id_is_returned()
    {
        $id = new PollId();
        $command = new VoteOption($id, 42);

        $this->assertSame($id, $command->getPollId());
    }

    /**
     * @test
     * @group unit
     */
    public function option_number_is_returned()
    {
        $id = new PollId();
        $command = new VoteOption($id, 42);

        $this->assertSame(42, $command->getOptionNumber());
    }

    /**
     * @test
     * @group unit
     */
    public function valid_serialized_data_can_be_successfully_deserialized()
    {
        $id = new PollId();
        $serialized = array('pollId' => (string) $id, 'optionNumber' => 1);

        $command = VoteOption::deserialize($serialized);

        $this->assertInstanceOf('Pollo\Core\Domain\Command\Poll\VoteOption', $command);
    }

    /**
     * @test
     * @group unit
     * @expectedException Pollo\Core\Domain\Command\Exception\CannotDeserializeCommand
     */
    public function invalid_serialized_data_should_throw_exception()
    {
        $serialized = array();
        VoteOption::deserialize($serialized);
    }
}
