<?php

namespace Pollo\Domain\Model\Poll;

use Pollo\Domain\Entity;
use Pollo\Domain\Model\Poll\Event\OptionVotedEvent;

/**
 * Class Option
 *
 * @package Pollo\Domain\Model\Poll
 */
final class Option extends Entity
{
    /** @var int */
    private $number;

    /** @var string */
    private $name;

    /** @var int */
    private $votes;

    /**
     * Returns a new Option
     *
     * @param int $number Option number
     * @param string $name Option name
     * @param int $votes Number of votes
     */
    public function __construct($number, $name, $votes = 0)
    {
        $this->number = (int) $number;
        $this->name = (string) $name;
        $this->votes = (int) $votes;
    }

    /**
     * @param OptionVotedEvent $event
     */
    protected function applyOptionVotedEvent(OptionVotedEvent $event)
    {
        $number = $event->getOptionNumber();

        if ($number === $this->number) {
            $this->votes++;
        }
    }
}
