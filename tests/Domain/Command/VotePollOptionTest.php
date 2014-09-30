<?php

namespace PolloTest\Domain\Command;

use Pollo\Domain\Command\VotePollOption;
use Pollo\Domain\Model\Poll\PollOptionId;
use PolloTest\TestCase;

class VotePollOptionTest extends TestCase
{
    /** @test */
    public function get_poll_option_id()
    {
        $id = new PollOptionId();
        $command = new VotePollOption($id);

        $this->assertSame($id, $command->getPollOptionId());
    }
}