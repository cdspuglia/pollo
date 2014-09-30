<?php

namespace Pollo\ValueObject;

interface ValueObjectInterface
{
    /**
     * Compares two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object);

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString();
}
