<?php

namespace Pollo\Config;

use Aura\Di\Config;
use Aura\Di\Container;
use Symfony\Component\Debug\Debug;

class Dev extends Config
{
    public function define(Container $di)
    {
        Debug::enable(E_ALL);
    }

    public function modify(Container $di)
    {
    }
}
