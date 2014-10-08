<?php

namespace Pollo\Core\Validator;

use Rhumsaa\Uuid\Uuid;

final class Uuidv4 implements ValidatorInterface
{
    /**
     * @param string $uuid
     * @return bool
     */
    public function isSatisfiedBy($uuid)
    {
        return Uuid::isValid($uuid);
    }
}
