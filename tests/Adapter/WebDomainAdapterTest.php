<?php

namespace PolloTest\Adapter;

use Pollo\Adapter\WebDomainAdapter;
use PolloTest\TestCase;

class WebDomainAdapterTest extends TestCase
{
    /** @var WebDomainAdapter */
    private $adapter;

    /** @var Broadway\CommandHandling\CommandBusInterface */
    private $commandBus;

    /** @var Pollo\Adapter\WebCommandMapper */
    private $mapper;

    public function setup()
    {
        $this->commandBus = $this->getMock('Broadway\CommandHandling\CommandBusInterface');
        $this->mapper = $this->getMock('Pollo\Adapter\Mapper\CommandMapperInterface');
        $this->adapter = new WebDomainAdapter($this->commandBus, $this->mapper);
    }

    /**
     * @test
     * @group unit
     */
    public function applied_web_command_is_converted_and_dispatched()
    {
        $domainCommand = new TestDomainCommand();
        $domainClass = get_class($domainCommand);

        $this->mapper
            ->method('map')
            ->will($this->returnValue($domainClass));

        $command = $this->getMock('Pollo\Adapter\Command\WebCommandInterface');
        $command
            ->method('serialize')
            ->will($this->returnValue(array()));

        $this->commandBus
            ->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo($domainCommand));

        $this->adapter->apply($command);
    }

    /**
     * @test
     * @group unit
     * @expectedException Pollo\Adapter\Exception\DomainCommandNotFound
     */
    public function unmapped_web_command_should_throw_exception()
    {
        $command = $this->getMock('Pollo\Adapter\Command\WebCommandInterface');
        $this->adapter->apply($command);
    }

    /**
     * @test
     * @group unit
     * @expectedException \LogicException
     */
    public function apply_non_web_command_should_throw_exception()
    {
        $command = $this->getMock('Pollo\Adapter\Command\CommandInterface');
        $this->adapter->apply($command);
    }

    /**
     * @test
     * @group unit
     * @expectedException Pollo\Adapter\Exception\CannotApplyWebCommand
     */
    public function domain_exception_should_be_converted_to_adapter_exception()
    {
        $domainException = $this->getMock('Pollo\Core\Domain\DomainException');
        $this->commandBus
            ->method('dispatch')
            ->will($this->throwException($domainException));

        $domainCommand = new TestDomainCommand();
        $domainClass = get_class($domainCommand);

        $this->mapper
            ->method('map')
            ->will($this->returnValue($domainClass));

        $command = $this->getMock('Pollo\Adapter\Command\WebCommandInterface');
        $command
            ->method('serialize')
            ->will($this->returnValue(array()));

        $this->adapter->apply($command);
    }
}
