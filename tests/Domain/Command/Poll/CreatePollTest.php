<?php

namespace PolloTest\Domain\Command;

use Pollo\Domain\Command\Poll\CreatePoll;
use Pollo\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class CreatePollTest extends TestCase
{
    /** @test */
    public function poll_id_is_returned()
    {
        $id = new PollId();
        $command = new CreatePoll($id, 'Title');

        $this->assertSame($id, $command->getPollId());
    }

    /** @test */
    public function poll_title_is_returned()
    {
        $id = new PollId();
        $command = new CreatePoll($id, 'Title');

        $this->assertSame('Title', $command->getTitle());
    }
}
