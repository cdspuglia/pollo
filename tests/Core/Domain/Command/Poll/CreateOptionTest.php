<?php

namespace PolloTest\Core\Domain\Command;

use Pollo\Core\Domain\Command\Poll\CreateOption;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class CreateOptionTest extends TestCase
{
    /** @test */
    public function poll_id_is_returned()
    {
        $id = new PollId();
        $command = new CreateOption($id, 'Name');

        $this->assertSame($id, $command->getPollId());
    }

    /** @test */
    public function option_name_is_returned()
    {
        $id = new PollId();
        $command = new CreateOption($id, 'Name');

        $this->assertSame('Name', $command->getName());
    }
}