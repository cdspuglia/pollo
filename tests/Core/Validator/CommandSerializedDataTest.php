<?php

namespace PolloTest\Core\Validator;

use Pollo\Core\Validator\CommandSerializedData;
use PolloTest\TestCase;

class CommandSerializedDataTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function valid_serialized_data_returns_true()
    {
        $validator = new CommandSerializedData(array('valid_key'));
        $validData = array('valid_key' => 'value');

        $this->assertTrue($validator->isSatisfiedBy($validData));
    }

    /**
     * @test
     * @group unit
     */
    public function invalid_serialized_data_returns_true()
    {
        $validator = new CommandSerializedData(array('valid_key'));
        $invalidData = array('invalid_key' => 'value');

        $this->assertFalse($validator->isSatisfiedBy($invalidData));
    }
}
