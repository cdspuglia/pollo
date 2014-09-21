<?php

namespace Pollo\Application;

final class WebApplication implements ApplicationInterface
{
    /** @var string Application root path */
    private $path;

    public function __construct($path)
    {
        $this->path = (string) $path;
    }

    /**
     *
     */
    public function run()
    {
        $kernel = (new \Aura\Project_Kernel\Factory)->newKernel(
            $this->path,
            'Aura\Web_Kernel\WebKernel'
        );
        $kernel();
    }
}