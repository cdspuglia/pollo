<?php

namespace PolloTest\Core\Domain\Model\Poll\Event;

use Pollo\Core\Domain\Model\Poll\Event\OptionCreatedEvent;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class OptionCreatedEventTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function get_poll_id_returns_correct_id()
    {
        $id = new PollId();
        $event = new OptionCreatedEvent($id, 'Option name');

        $this->assertEquals($id, $event->getPollId());
    }

    /**
     * @test
     * @group unit
     */
    public function get_name_returns_correct_value()
    {
        $id = new PollId();
        $event = new OptionCreatedEvent($id, 'Option name');

        $this->assertEquals('Option name', $event->getName());
    }

    /**
     * @test
     * @group unit
     */
    public function deserialized_and_serialized_event_has_same_values()
    {
        $id = new PollId();
        $data = array('pollId' => (string) $id, 'name' => 'Option name');
        $event = OptionCreatedEvent::deserialize($data);

        $this->assertSame($data, $event->serialize());
    }
}
