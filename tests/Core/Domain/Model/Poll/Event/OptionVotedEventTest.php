<?php

namespace PolloTest\Core\Domain\Model\Poll\Event;

use Pollo\Core\Domain\Model\Poll\Event\OptionVotedEvent;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class OptionVotedEventTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function get_poll_id_returns_correct_id()
    {
        $id = new PollId();
        $event = new OptionVotedEvent($id, 1);

        $this->assertEquals($id, $event->getPollId());
    }

    /**
     * @test
     * @group unit
     */
    public function get_option_number_returns_correct_value()
    {
        $id = new PollId();
        $event = new OptionVotedEvent($id, 2);

        $this->assertEquals(2, $event->getOptionNumber());
    }

    /**
     * @test
     * @group unit
     */
    public function deserialized_and_serialized_event_has_same_values()
    {
        $id = new PollId();
        $data = array('pollId' => (string) $id, 'optionNumber' => 2);
        $event = OptionVotedEvent::deserialize($data);

        $this->assertSame($data, $event->serialize());
    }
}
