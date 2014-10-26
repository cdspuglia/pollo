<?php

namespace PolloTest\Core\Domain\Model\Poll\Validator;

use Pollo\Core\Domain\Model\Poll\Validator\PollTitleValidator;
use PolloTest\TestCase;

class PollTitleValidatorTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function empty_string_returns_false()
    {
        $validator = new PollTitleValidator();
        $this->assertFalse($validator->isSatisfiedBy(''));
    }

    /**
     * @test
     * @group unit
     */
    public function non_empty_string_returns_true()
    {
        $validator = new PollTitleValidator();
        $this->assertTrue($validator->isSatisfiedBy('Title'));
    }
}
