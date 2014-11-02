<?php

namespace Pollo\Adapter\Command;

interface DomainCommandInterface extends CommandInterface
{
    /**
     * Creates a new instance from serialized data
     *
     * @param array $data
     * @return self
     */
    public static function deserialize(array $data);
}
