<?php

namespace Pollo\Web\Command;

use Pollo\Adapter\Command\WebCommandInterface;

class CreatePoll implements WebCommandInterface
{
    /** @var string */
    private $pollId;

    /** @var string */
    private $title;

    /**
     * @param string $poll_id
     * @param string $title
     */
    public function __construct($poll_id, $title)
    {
        $this->pollId = (string) $poll_id;
        $this->title = (string) $title;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return array(
            'pollId' => $this->pollId,
            'title' => $this->title
        );
    }

    /**
     * @return string
     */
    public function getCommandName()
    {
        return 'create_poll';
    }
}
