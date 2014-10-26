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
}
