<?php

namespace Pollo\Adapter\Mapper;

use Pollo\Adapter\Command\CommandInterface;

interface CommandMapperInterface
{
    /**
     * Maps between given command and the correspondent class in another module
     *
     * @param CommandInterface $command
     * @return string
     */
    public function map(CommandInterface $command);
}
