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


        // Template engine
        $di->set('pollo/web:templating', $di->lazyNew('Pollo\Web\Templating\TwigTemplateEngine', array(
            'loader' => $di->lazyNew(
                    '\Twig_Loader_Filesystem',
                    array(__DIR__ . '/../src/Pollo/Web/Resources/templates')
                )
        )));
    }

    public function modify(Container $di)
    {
    }
}
