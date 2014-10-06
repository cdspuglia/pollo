<?php

namespace Pollo\Core\Domain\Model\Poll\Validator;

use Pollo\Core\Validator\ValidatorInterface;

final class OptionNumberValidator implements ValidatorInterface
{
    /** @var array */
    private $options;

    /**
     * @param Options[] $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param int $option_number
     * @return bool
     */
    public function isSatisfiedBy($option_number)
    {
        return array_key_exists($option_number, $this->options);
    }
}
