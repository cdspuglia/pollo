<?php

namespace PolloTest\ValueObject\Uuid;

use PolloTest\TestCase;

class UuidTest extends TestCase
{
    /** @test */
    public function uuid_value_is_generated()
    {
        $uuid = $this->getMockForAbstractClass('Pollo\ValueObject\Uuid\Uuid');
        $pattern = '/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/';

        $this->assertRegExp($pattern, $uuid->__toString());
    }

    /** @test */
    public function passed_uuid_is_retained()
    {
        $uuidValue = '123e4567-e89b-12d3-a456-426655440000';
        $uuid = $this->getMockBuilder('Pollo\ValueObject\Uuid\Uuid')
            ->setConstructorArgs(array($uuidValue))
            ->getMockForAbstractClass();

        $this->assertEquals($uuidValue, $uuid->__toString());
    }

    /**
     * @test
     */
    public function invalid_uuid_throws_exception()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            "'1234' is not a valid uuid."
        );

        $this->getMockBuilder('Pollo\ValueObject\Uuid\Uuid')
            ->setConstructorArgs(array('1234'))
            ->getMockForAbstractClass();
    }
}