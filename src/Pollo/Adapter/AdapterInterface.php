<?php

namespace Pollo\Adapter;

use Pollo\Adapter\Command\CommandInterface;

interface AdapterInterface
{
    /**
     * Applies given command across modules
     *
     * @param CommandInterface $command
     * @return void
     */
    public function apply(CommandInterface $command);
}
