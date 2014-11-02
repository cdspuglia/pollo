<?php

namespace PolloTest\Adapter;

use Pollo\Adapter\Command\DomainCommandInterface;

class TestDomainCommand implements DomainCommandInterface
{
    /**
     * Creates a new instance from serialized data
     *
     * @param array $data
     * @return self
     */
    public static function deserialize(array $data)
    {
        return new self();
    }
}

