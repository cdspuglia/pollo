<?php

namespace PolloTest\Core\Domain\Model\Poll\Validator;

use Pollo\Core\Domain\Model\Poll\Validator\OptionNumberValidator;
use PolloTest\TestCase;

class OptionNumberValidatorTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function non_existent_option_index_returns_false()
    {
        $validator = new OptionNumberValidator(
            array('One', 'Two', 'Three')
        );
        $this->assertFalse($validator->isSatisfiedBy(4));
    }

    /**
     * @test
     * @group unit
     */
    public function existing_option_index_returns_true()
    {
        $validator = new OptionNumberValidator(
            array('One', 'Two', 'Three')
        );
        $this->assertTrue($validator->isSatisfiedBy(2));
    }
}
