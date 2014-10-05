<?php

namespace Pollo\Domain\Model\Poll\Exception;

final class InvalidOptionName extends \Exception
{
    public function __construct($option_name)
    {
        $this->message = "Invalid option name '$option_name'";
    }
}
