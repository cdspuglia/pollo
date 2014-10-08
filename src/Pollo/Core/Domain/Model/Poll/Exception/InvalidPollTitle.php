<?php

namespace Pollo\Core\Domain\Model\Poll\Exception;

final class InvalidPollTitle extends \Exception
{
    /**
     * @param string $poll_title
     */
    public function __construct($poll_title)
    {
        $this->message = "Invalid poll title '$poll_title'";
    }
}
