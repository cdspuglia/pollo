<?php

namespace PolloTest\Core\ValueObject\Uuid;

use PolloTest\TestCase;

class UuidTest extends TestCase
{
    /**
     * @test
     * @group unit
     */
    public function uuid_value_is_generated()
    {
        $uuid = $this->getMockForAbstractClass('Pollo\Core\ValueObject\Uuid\Uuid');
        $pattern = '/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/';

        $this->assertRegExp($pattern, $uuid->__toString());
    }

    /**
     * @test
     * @group unit
     */
    public function passed_uuid_is_retained()
    {
        $uuidValue = '123e4567-e89b-12d3-a456-426655440000';
        $uuid = $this->getMockBuilder('Pollo\Core\ValueObject\Uuid\Uuid')
            ->setConstructorArgs([$uuidValue])
            ->getMockForAbstractClass();

        $this->assertEquals($uuidValue, $uuid->__toString());
    }

    /**
     * @test
     * @group unit
     */
    public function invalid_uuid_throws_exception()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            "'1234' is not a valid uuid."
        );

        $this->getMockBuilder('Pollo\Core\ValueObject\Uuid\Uuid')
            ->setConstructorArgs(array('1234'))
            ->getMockForAbstractClass();
    }

    /**
     * @test
     * @group unit
     * @dataProvider two_same_value_data_provider
     */
    public function two_same_value_uuid_are_considered_equal($uuid2Value, $expected)
    {
        $uuidValue = '123e4567-e89b-12d3-a456-426655440000';

        /** @var Pollo\Core\ValueObject\Uuid\Uuid $uuid */
        $uuid = $this->getMockBuilder('Pollo\Core\ValueObject\Uuid\Uuid')
            ->setConstructorArgs(array($uuidValue))
            ->getMockForAbstractClass();

        /** @var Pollo\Core\ValueObject\Uuid\Uuid $uuid2 */
        $uuid2 = $this->getMockBuilder('Pollo\Core\ValueObject\Uuid\Uuid')
            ->setConstructorArgs(array($uuid2Value))
            ->getMockForAbstractClass();

        $this->assertEquals($expected, $uuid->sameValueAs($uuid2));
    }

    public function two_same_value_data_provider()
    {
        return array(
            array('123e4567-e89b-12d3-a456-426655440000', true),
            array('123e4567-e89b-12d3-a456-426655441111', false)
        );
    }
}
