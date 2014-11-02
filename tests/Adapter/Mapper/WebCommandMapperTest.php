<?php

namespace PolloTest\Adapter\Mapper;

use Pollo\Adapter\Mapper\WebCommandMapper;
use PolloTest\TestCase;

class WebCommandMapperTest extends TestCase
{
    /**
     * @test
     * @group unit
     * @dataProvider commandNameClassMapDataProvider
     */
    public function mapped_web_command_should_return_correct_class_name($command_name, $class_name)
    {
        $command = $this->getMock('Pollo\Adapter\Command\WebCommandInterface');
        $command
            ->method('getCommandName')
            ->will($this->returnValue($command_name));

        $mapper = new WebCommandMapper();
        $className = $mapper->map($command);

        $this->assertSame($class_name, $className);
    }

    public function commandNameClassMapDataProvider()
    {
        return array(
            array('create_poll', 'Pollo\Core\Domain\Command\Poll\CreatePoll')
        );
    }

    /**
     * @test
     * @group unit
     * @expectedException \LogicException
     */
    public function non_web_command_should_throw_exception()
    {
        $command = $this->getMock('Pollo\Adapter\Command\CommandInterface');

        $mapper = new WebCommandMapper();
        $mapper->map($command);
    }

    /**
     * @test
     * @group unit
     */
    public function unmapped_web_command_should_return_null()
    {
        $command = $this->getMock('Pollo\Adapter\Command\WebCommandInterface');
        $command
            ->method('getCommandName')
            ->will($this->returnValue('unmapped_command'));

        $mapper = new WebCommandMapper();
        $className = $mapper->map($command);

        $this->assertNull($className);
    }
}
