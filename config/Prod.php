<?php

namespace Pollo\Config;

use Aura\Di\Config;
use Aura\Di\Container;

class Prod extends Config
{
    public function define(Container $di)
    {
        // Template engine
        $di->set('pollo/web:templating', $di->lazyNew('Pollo\Web\Templating\TwigTemplateEngine', array(
            'loader' => $di->lazyNew(
                    '\Twig_Loader_Filesystem',
                    array(__DIR__ . '/../src/Pollo/Web/Resources/templates')
                ),
            'options' => array('cache' => __DIR__ . '/../tmp/cache/twig')
        )));
    }

    public function modify(Container $di)
    {

    }
}
