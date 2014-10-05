<?php

namespace PolloTest\Domain\Command;

use Pollo\Domain\Command\Poll\VoteOption;
use Pollo\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class VoteOptionTest extends TestCase
{
    /** @test */
    public function poll_id_is_returned()
    {
        $id = new PollId();
        $command = new VoteOption($id, 42);

        $this->assertSame($id, $command->getPollId());
    }

    /** @test */
    public function option_number_is_returned()
    {
        $id = new PollId();
        $command = new VoteOption($id, 42);

        $this->assertSame(42, $command->getOptionNumber());
    }
}