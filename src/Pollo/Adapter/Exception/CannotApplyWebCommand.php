<?php

namespace Pollo\Adapter\Exception;

final class CannotApplyWebCommand extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
