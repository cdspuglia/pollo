<?php

namespace Pollo\Validator;

interface ValidatorInterface
{
    /**
     * Tells whether given object or value satisfies the validator
     *
     * @param $object_or_value
     * @return bool
     */
    public function isSatisfiedBy($object_or_value);
}
