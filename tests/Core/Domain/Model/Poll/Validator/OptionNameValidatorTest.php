<?php

namespace PolloTest\Core\Domain\Model\Poll\Validator;

use Pollo\Core\Domain\Model\Poll\Validator\OptionNameValidator;
use PolloTest\TestCase;

class OptionNameValidatorTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function empty_string_returns_false()
    {
        $validator = new OptionNameValidator();
        $this->assertFalse($validator->isSatisfiedBy(''));
    }

    /**
     * @test
     * @group unit
     */
    public function non_empty_string_returns_true()
    {
        $validator = new OptionNameValidator();
        $this->assertTrue($validator->isSatisfiedBy('Foo'));
    }
}
