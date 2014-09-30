<?php

namespace Pollo\Domain\Model\Poll;

/**
 * Class PollOption
 *
 * @package Pollo\Domain\Model\Poll
 */
final class PollOption
{
    /** @var PollOptionId */
    private $id;

    /** @var string Option name */
    private $name;

    /**
     * Returns a new PollOption
     *
     * @param PollOptionId $id
     * @param string $name Option name
     */
    public function __construct(PollOptionId $id, $name)
    {
        $this->name = (string) $name;
    }
}