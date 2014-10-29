<?php

namespace PolloTest\Core\Domain\Model\Poll\Event;

use Pollo\Core\Domain\Model\Poll\Event\PollCreatedEvent;
use Pollo\Core\Domain\Model\Poll\PollId;
use PolloTest\TestCase;

class PollCreatedEventTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function get_poll_id_returns_correct_id()
    {
        $id = new PollId();
        $event = new PollCreatedEvent($id, 'Title');

        $this->assertEquals($id, $event->getPollId());
    }

    /**
     * @test
     * @group unit
     */
    public function get_title_returns_correct_title()
    {
        $id = new PollId();
        $event = new PollCreatedEvent($id, 'Title');

        $this->assertEquals('Title', $event->getTitle());
    }

    /**
     * @test
     * @group unit
     */
    public function deserialized_and_serialized_event_has_same_values()
    {
        $id = new PollId();
        $data = array('pollId' => (string) $id, 'title' => 'Title');
        $event = PollCreatedEvent::deserialize($data);

        $this->assertSame($data, $event->serialize());
    }
}
