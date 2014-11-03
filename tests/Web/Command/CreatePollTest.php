<?php

namespace PolloTest\Web\Command;

use Pollo\Web\Command\CreatePoll;
use PolloTest\TestCase;

class CreatePollTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function serialize_returns_correct_array()
    {
        $command = new CreatePoll('poll-id', 'Poll title');
        $serialized = $command->serialize();
        $expected = array('pollId' => 'poll-id', 'title' => 'Poll title');

        $this->assertSame($expected, $serialized);
    }

    /**
     * @test
     * @group unit
     */
    public function command_name_is_returned()
    {
        $command = new CreatePoll('poll-id', 'Poll title');

        $this->assertSame('create_poll', $command->getCommandName());
    }
}
