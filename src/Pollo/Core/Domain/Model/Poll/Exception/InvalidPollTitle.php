<?php

namespace Pollo\Core\Domain\Model\Poll\Exception;

use Pollo\Core\Domain\DomainException;

final class InvalidPollTitle extends DomainException
{
    /**
     * @param string $poll_title
     */
    public function __construct($poll_title)
    {
        $this->message = "Invalid poll title '$poll_title'";
    }
}
