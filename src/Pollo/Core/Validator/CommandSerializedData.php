<?php

namespace Pollo\Core\Validator;

final class CommandSerializedData implements ValidatorInterface
{
    /** @var array */
    private $requiredKeys;

    /**
     * @param array $required_keys
     */
    public function __construct(array $required_keys)
    {
        $this->requiredKeys = $required_keys;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isSatisfiedBy($data)
    {
        $keys = array_keys($data);
        foreach ($this->requiredKeys as $requiredKey) {
            if (!in_array($requiredKey, $keys)) {
                return false;
            }
        }

        return true;
    }
}
