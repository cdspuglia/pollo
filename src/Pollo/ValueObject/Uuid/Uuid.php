<?php

namespace Pollo\ValueObject\Uuid;

use Pollo\Validator\Uuidv4;
use Pollo\ValueObject\HasStringValue;
use Rhumsaa\Uuid\Uuid as UuidGenerator;

/**
 * Base class for uuid value objects
 *
 * @package Pollo\ValueObject\Uuid
 */
abstract class Uuid
{
    use HasStringValue;

    /**
     * @param string|null $uuid
     */
    public function __construct($uuid = null)
    {
        if (null == $uuid) {
            $uuid = UuidGenerator::uuid4();
        }

        $validator = new Uuidv4();

        if (!$validator->isSatisfiedBy($uuid)) {
            throw new \InvalidArgumentException(
                "'$uuid' is not a valid uuid."
            );
        }

        $this->set($uuid);
    }
}
