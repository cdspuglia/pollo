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
    public function sameValueAs(ValueObjectInterface $object)
    {
        if (get_class() !== get_class($object)) {
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

    /**
     * Sets the underlying stirng value of the object
     *
     * @param string $value
     */
    protected function set($value)
    {
        $this->value = (string) $value;
    }
}
