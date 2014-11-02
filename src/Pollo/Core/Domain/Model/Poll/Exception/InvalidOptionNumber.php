<?php

namespace Pollo\Core\Domain\Model\Poll\Exception;

use Pollo\Core\Domain\DomainException;

final class InvalidOptionNumber extends DomainException
{
    /**
     * @param integer $option_number
     */
    public function __construct($option_number)
    {
        $this->message = "Invalid option number #$option_number";
    }
}
