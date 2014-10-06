<?php

namespace Pollo\Core\Domain\Model\Poll\Exception;

final class InvalidOptionNumber extends \Exception
{
    public function __construct($option_number)
    {
        $this->message = "Invalid option number #$option_number";
    }
}
