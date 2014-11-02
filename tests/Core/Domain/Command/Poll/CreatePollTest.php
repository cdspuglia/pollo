<?php

namespace PolloTest\Core\Domain\Command;

use Pollo\Core\Domain\Command\Poll\CreatePoll;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class CreatePollTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function poll_id_is_returned()
    {
        $id = new PollId();
        $command = new CreatePoll($id, 'Title');

        $this->assertSame($id, $command->getPollId());
    }

    /**
     * @test
     * @group unit
     */
    public function poll_title_is_returned()
    {
        $id = new PollId();
        $command = new CreatePoll($id, 'Title');

        $this->assertSame('Title', $command->getTitle());
    }

    /**
     * @test
     * @group unit
     */
    public function valid_serialized_data_can_be_successfully_deserialized()
    {
        $id = new PollId();
        $serialized = array('pollId' => (string) $id, 'title' => 'Poll title');

        $command = CreatePoll::deserialize($serialized);

        $this->assertInstanceOf('Pollo\Core\Domain\Command\Poll\CreatePoll', $command);
    }

    /**
     * @test
     * @group unit
     * @expectedException Pollo\Core\Domain\Command\Exception\CannotDeserializeCommand
     */
    public function invalid_serialized_data_should_throw_exception()
    {
        $serialized = array();
        CreatePoll::deserialize($serialized);
    }
}
