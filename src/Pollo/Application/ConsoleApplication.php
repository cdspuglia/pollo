<?php

namespace Pollo\Application;

final class ConsoleApplication implements ApplicationInterface
{
    /** @var int Exit status */
    private $exitStatus;

    /** @var string Application root path */
    private $path;

    public function __construct($path)
    {
        $this->path = (string) $path;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $kernel = (new \Aura\Project_Kernel\Factory)->newKernel(
            $this->path,
            'Aura\Cli_Kernel\CliKernel'
        );
        $this->exitStatus = $kernel();
    }

    /**
     * Returns the application exit status
     *
     * @return int
     */
    public function getExitStatus()
    {
        return $this->exitStatus;
    }
}