<?php

namespace Pollo\Adapter\Command;

interface WebCommandInterface extends CommandInterface
{
    /**
     * Get command name
     *
     * @return string
     */
    public function getCommandName();

    /**
     * Serialize command data to array
     *
     * @return array
     */
    public function serialize();
}
