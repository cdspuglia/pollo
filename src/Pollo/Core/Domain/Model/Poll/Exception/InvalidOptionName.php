<?php

namespace Pollo\Core\Domain\Model\Poll\Exception;

use Pollo\Core\Domain\DomainException;

final class InvalidOptionName extends DomainException
{
    /**
     * @param string $option_name
     */
    public function __construct($option_name)
    {
        $this->message = "Invalid option name '$option_name'";
    }
}
