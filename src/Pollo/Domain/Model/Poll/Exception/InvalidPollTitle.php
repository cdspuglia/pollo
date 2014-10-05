<?php

namespace Pollo\Domain\Model\Poll\Exception;

final class InvalidPollTitle extends \Exception
{
    public function __construct($poll_title)
    {
        $this->message = "Invalid poll title '$poll_title'";
    }
}
