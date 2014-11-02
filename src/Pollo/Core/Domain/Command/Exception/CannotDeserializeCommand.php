<?php

namespace Pollo\Core\Domain\Command\Exception;

use Pollo\Core\Domain\DomainException;

final class CannotDeserializeCommand extends DomainException
{
    /**
     * @param array $data
     * @param string $class_name
     */
    public function __construct(array $data, $class_name)
    {
        $keys = implode(', ', array_keys($data));
        $this->message = "Cannot deserialize array($keys) to $class_name";
    }
}
