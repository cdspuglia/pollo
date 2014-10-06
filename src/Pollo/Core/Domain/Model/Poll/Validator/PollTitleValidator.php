<?php

namespace Pollo\Core\Domain\Model\Poll\Validator;

use Pollo\Core\Validator\ValidatorInterface;

final class PollTitleValidator implements ValidatorInterface
{
    const MINIMUM_LENGTH = 1;

    /**
     * @param string $poll_title
     * @return bool
     */
    public function isSatisfiedBy($poll_title)
    {
        return strlen($poll_title) >= self::MINIMUM_LENGTH;
    }
}
