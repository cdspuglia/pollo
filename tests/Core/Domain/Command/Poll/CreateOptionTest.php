<?php

namespace PolloTest\Core\Domain\Command;

use Pollo\Core\Domain\Command\Poll\CreateOption;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class CreateOptionTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function poll_id_is_returned()
    {
        $id = new PollId();
        $command = new CreateOption($id, 'Name');

        $this->assertSame($id, $command->getPollId());
    }

    /**
     * @test
     * @group unit
     */
    public function option_name_is_returned()
    {
        $id = new PollId();
        $command = new CreateOption($id, 'Name');

        $this->assertSame('Name', $command->getName());
    }

    /**
     * @test
     * @group unit
     */
    public function valid_serialized_data_can_be_successfully_deserialized()
    {
        $id = new PollId();
        $serialized = array('pollId' => (string) $id, 'name' => 'Option name');

        $command = CreateOption::deserialize($serialized);

        $this->assertInstanceOf('Pollo\Core\Domain\Command\Poll\CreateOption', $command);
    }

    /**
     * @test
     * @group unit
     * @expectedException Pollo\Core\Domain\Command\Exception\CannotDeserializeCommand
     */
    public function invalid_serialized_data_should_throw_exception()
    {
        $serialized = array();
        CreateOption::deserialize($serialized);
    }
}
