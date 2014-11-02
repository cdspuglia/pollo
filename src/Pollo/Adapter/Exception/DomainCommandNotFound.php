<?php

namespace Pollo\Adapter\Exception;

final class DomainCommandNotFound extends \Exception
{
    /**
     * @param string $domain_class
     */
    public function __construct($domain_class)
    {
        $this->message = "Domain command '$domain_class' not found.";
    }
}
