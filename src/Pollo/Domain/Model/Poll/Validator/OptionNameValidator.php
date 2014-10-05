<?php

namespace Pollo\Domain\Model\Poll\Validator;

use Pollo\Validator\ValidatorInterface;

final class OptionNameValidator implements ValidatorInterface
{
    const MINIMUM_LENGTH = 1;

    /**
     * @param string $option_name
     * @return bool
     */
    public function isSatisfiedBy($option_name)
    {
        return strlen($option_name) >= self::MINIMUM_LENGTH;
    }
}
