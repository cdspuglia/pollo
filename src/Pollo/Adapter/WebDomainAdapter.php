<?php

namespace Pollo\Adapter;

use Broadway\CommandHandling\CommandBusInterface;
use Pollo\Adapter\Command\CommandInterface;
use Pollo\Adapter\Command\DomainCommandInterface;
use Pollo\Adapter\Command\WebCommandInterface;
use Pollo\Adapter\Exception\CannotApplyWebCommand;
use Pollo\Adapter\Exception\DomainCommandNotFound;
use Pollo\Adapter\Mapper\CommandMapperInterface;
use Pollo\Core\Domain\DomainException;

final class WebDomainAdapter implements AdapterInterface
{
    /** @var CommandBusInterface */
    private $commandBus;

    /** @var CommandMapperInterface */
    private $mapper;

    /**
     * @param CommandBusInterface $bus
     * @param CommandMapperInterface $mapper
     */
    public function __construct(CommandBusInterface $bus, CommandMapperInterface $mapper)
    {
        $this->commandBus = $bus;
        $this->mapper = $mapper;
    }

    /**
     * Applies a web command to the domain
     *
     * @param CommandInterface $web_command
     * @throws \LogicException
     * @throws CannotApplyWebCommand
     */
    public function apply(CommandInterface $web_command)
    {
        if (!$web_command instanceof WebCommandInterface) {
            throw new \LogicException('Given command must implement WebCommandInterface');
        }

        try {
            $domainCommand = $this->toDomainCommand($web_command);
            $this->commandBus->dispatch($domainCommand);
        } catch (DomainException $exception) {
            throw new CannotApplyWebCommand($exception->getMessage());
        }
    }

    /**
     * Converts a web command to a correspondent domain command
     *
     * @param WebCommandInterface $web_command
     * @return DomainCommandInterface
     * @throws DomainCommandNotFound
     */
    private function toDomainCommand(WebCommandInterface $web_command)
    {
        $domainClass = $this->mapper->map($web_command);

        if (
            null === $domainClass ||
            !in_array('Pollo\Adapter\Command\DomainCommandInterface', class_implements($domainClass))
        ) {
            throw new DomainCommandNotFound($domainClass);
        }

        $webCommandData = $web_command->serialize();
        $domainCommand = $domainClass::deserialize($webCommandData);

        return $domainCommand;
    }
}
