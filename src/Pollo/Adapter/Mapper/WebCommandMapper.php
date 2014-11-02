<?php

namespace Pollo\Adapter\Mapper;

use Pollo\Adapter\Command\CommandInterface;
use Pollo\Adapter\Command\WebCommandInterface;

final class WebCommandMapper implements CommandMapperInterface
{
    /**
     * @var array Map between web command names and domain command classes
     */
    private $map = array(
        'create_poll' => 'Pollo\Core\Domain\Command\Poll\CreatePoll'
    );

    /**
     * Returns the correspondent domain command class name for given web command
     *
     * @param CommandInterface $web_command
     * @return string|null
     * @throws \LogicException
     */
    public function map(CommandInterface $web_command)
    {
        if (!$web_command instanceof WebCommandInterface) {
            throw new \LogicException(
                sprintf(
                    "Given command '%s' doesn't implement Pollo\\Adapter\\Command\\WebCommandInterface",
                    get_class($web_command)
                )
            );
        }

        $name = $web_command->getCommandName();

        if (isset($this->map[$name])) {
            return $this->map[$name];
        }

        return null;
    }
}
