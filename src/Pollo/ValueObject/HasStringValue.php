<?php

namespace Pollo\ValueObject;

trait HasStringValue
{
    /** @var string */
    protected $value;

    /**
     * Tells whether two value objects are equal
     *
     * @param ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs($object)
    {
        if (get_class($this) !== get_class($object)) {
            return false;
        }

        return $this->__toString() === $object->__toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
